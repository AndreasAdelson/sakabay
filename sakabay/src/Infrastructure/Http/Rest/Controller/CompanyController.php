<?php

namespace App\Infrastructure\Http\Rest\Controller;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Application\Form\Type\CompanyType;
use App\Application\Form\Type\CompanyAdminEditType;
use App\Application\Service\CompanyStatutService;
use App\Application\Service\CompanyService;
use App\Application\Service\FileUploader;
use App\Domain\Model\Company;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mime\Message;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class CompanyController extends AbstractFOSRestController
{
    private $entityManager;
    private $companyService;
    private $companyStatutService;
    private $translator;
    private $encoder;

    /**
     * CompanyRestController constructor.
     */
    public function __construct(EntityManagerInterface $entityManager, CompanyService $companyService, CompanyStatutService $companyStatutService, TranslatorInterface $translator, UserPasswordEncoderInterface $encoder, MailerInterface $mailer)
    {
        $this->entityManager = $entityManager;
        $this->translator = $translator;
        $this->companyService = $companyService;
        $this->companyStatutService = $companyStatutService;
        $this->encoder = $encoder;
    }

    /**
     * @Rest\View()
     * @Rest\Post("/companies")
     * @param Request $request
     *
     * @return View
     */
    public function createCompany(Request $request, FileUploader $uploader, string $uploadDir)
    {
        $company = new Company();
        $file = $request->files->get('file');

        if (!empty($file)) {
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFileName);
            $newFileName = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
            $uploader->upload($uploadDir, $file, $newFileName);
            $requestUtilisateur = $request->request->get('utilisateur');
            $requestUtilisateur['imageProfil'] = $newFileName;
            $request->request->set('utilisateur', $requestUtilisateur);
        }
        $formOptions = ['translator' => $this->translator];
        $form = $this->createForm(CompanyType::class, $company, $formOptions);
        $form->submit($request->request->all());
        if (!$form->isValid()) {
            return $form;
        }

        $urlName  = $this->recastName($company->getName());
        $company->setUrlName($urlName);

        //TODO Faire une fonction qui génère un mdp aléatoire lorsqu'on se penche sur l'envoie d'un email pour vérifier le mdp créé.
        $plainPassword = 'test';
        $encoded = $this->encoder->encodePassword($company->getUtilisateur(), $plainPassword);

        $login = str_replace('-', '', $urlName);
        $company->getUtilisateur()->setLogin(strtoupper($login));
        $company->getUtilisateur()->setPassword($encoded);
        $companyStatut = $this->companyStatutService->getENCCompanyStatut()[0];
        $company->setCompanystatut($companyStatut);

        $this->entityManager->persist($company);
        $this->entityManager->flush();
        //TODO Envoie de l'email

        $ressourceLocation = $this->generateUrl('home');

        $this->sendMail('L\'entreprise ' . $company->getName() . ' son inscription est en cours de validation');
        return View::create([], Response::HTTP_CREATED, ['Location' => $ressourceLocation]);
    }


    /**
     * @Rest\View(serializerGroups={"api_companies"})
     * @Rest\Get("/companies")
     *
     * - - - - - - - - - - - - Query group for paginated admin list - - - - - - - - - - - - -
     * Retrieves sorted list of all companies
     * - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
     * @QueryParam(name="filterFields",
     *             default="name",
     *             description="Liste des champs sur lesquels le filtre s'appuie"
     * )
     * @QueryParam(name="filter",
     *             default="",
     *             description="Filtre"
     * )
     * @QueryParam(name="sortBy",
     *             default="name",
     *             description="Champ unique sur lequel s'opère le tri"
     * )
     * @QueryParam(name="sortDesc",
     *             default="false",
     *             description="Sens du tri"
     * )
     * @QueryParam(name="currentPage",
     *             default="1",
     *             description="Page courante"
     * )
     * @QueryParam(name="perPage",
     *             default="1000000",
     *             description="Taille de la page"
     * )
     * @QueryParam(name="codeStatut",
     *             default="",
     *             description="Statut d'une entreprise"
     * )
     *
     * @QueryParam(name="category",
     *             default="",
     *             description="Identifiant d'une catégorie"
     * )
     * @return View
     */

    public function getCompanys(ParamFetcher $paramFetcher): View
    {
        $filterFields = $paramFetcher->get('filterFields');
        $filter = $paramFetcher->get('filter');
        $sortBy = $paramFetcher->get('sortBy');
        $sortDesc = $paramFetcher->get('sortDesc');
        $currentPage = $paramFetcher->get('currentPage');
        $perPage = $paramFetcher->get('perPage');
        $codeStatut = $paramFetcher->get('codeStatut');
        $category = $paramFetcher->get('category');


        $pager = $this->companyService
            ->getPaginatedList($sortBy, 'true' === $sortDesc, $filterFields, $filter, $currentPage, $perPage, $codeStatut, $category);
        $companies = $pager->getCurrentPageResults();
        $nbResults = $pager->getNbResults();
        $datas = iterator_to_array($companies);
        $view = $this->view($datas, Response::HTTP_OK);
        $view->setHeader('X-Total-Count', $nbResults);

        return $view;
    }

    /**
     * @Rest\View(serializerGroups={"api_companies"})
     * @Rest\Get("companies/{companyId}")
     *
     * @return View
     */
    public function getCompany(int $companyId): View
    {
        $company = $this->companyService->getCompany($companyId);

        return View::create($company, Response::HTTP_OK);
    }

    /**
     * @Rest\View(serializerGroups={"api_admin_companies"})
     * @Rest\Get("admin/companies")
     *
     * - - - - - - - - - - - - Query group for paginated admin list - - - - - - - - - - - - -
     * Retrieves sorted list of all companies
     * - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
     * @QueryParam(name="filterFields",
     *             default="name",
     *             description="Liste des champs sur lesquels le filtre s'appuie"
     * )
     * @QueryParam(name="filter",
     *             default="",
     *             description="Filtre"
     * )
     * @QueryParam(name="sortBy",
     *             default="name",
     *             description="Champ unique sur lequel s'opère le tri"
     * )
     * @QueryParam(name="sortDesc",
     *             default="false",
     *             description="Sens du tri"
     * )
     * @QueryParam(name="currentPage",
     *             default="1",
     *             description="Page courante"
     * )
     * @QueryParam(name="perPage",
     *             default="1000000",
     *             description="Taille de la page"
     * )
     * @QueryParam(name="codeStatut",
     *             default="",
     *             description="Statut d'une entreprise"
     * )
     *
     * @QueryParam(name="category",
     *             default="",
     *             description="Identifiant d'une catégorie"
     * )
     * @return View
     */

    public function getAdminCompanys(ParamFetcher $paramFetcher): View
    {
        $filterFields = $paramFetcher->get('filterFields');
        $filter = $paramFetcher->get('filter');
        $sortBy = $paramFetcher->get('sortBy');
        $sortDesc = $paramFetcher->get('sortDesc');
        $currentPage = $paramFetcher->get('currentPage');
        $perPage = $paramFetcher->get('perPage');
        $codeStatut = $paramFetcher->get('codeStatut');
        $category = $paramFetcher->get('category');


        $pager = $this->companyService
            ->getPaginatedList($sortBy, 'true' === $sortDesc, $filterFields, $filter, $currentPage, $perPage, $codeStatut, $category);
        $companies = $pager->getCurrentPageResults();
        $nbResults = $pager->getNbResults();
        $datas = iterator_to_array($companies);
        $view = $this->view($datas, Response::HTTP_OK);
        $view->setHeader('X-Total-Count', $nbResults);

        return $view;
    }

    /**
     * @Rest\View(serializerGroups={"api_admin_companies"})
     * @Rest\Get("admin/companies/{companyId}")
     *
     * @return View
     */
    public function getAdminCompany(int $companyId): View
    {
        $company = $this->companyService->getCompany($companyId);

        return View::create($company, Response::HTTP_OK);
    }


    /**
     * @Rest\View(serializerGroups={"api_companies"})
     * @Rest\Get("entreprise/{urlName}")
     *
     * @return View
     */
    public function getCompanyByUrlName(string $urlName): View
    {
        $company = $this->companyService->getCompanyByUrlName($urlName);
        if (!$company) {
            throw new NotFoundHttpException('Company with url_name ' . $urlName . ' does not exist!');
        }
        return View::create($company, Response::HTTP_OK);
    }

    /**
     * @Rest\View()
     * @Rest\Post("admin/companies/{companyId}")
     * @Security("is_granted('ROLE_UCOMPANY')")
     *
     * @return View
     */
    public function editAdminCompany(int $companyId, Request $request)
    {
        $company = $this->companyService->getCompany($companyId);
        if (!$company) {
            throw new EntityNotFoundException('Company with id ' . $companyId . ' does not exist!');
        }

        $formOptions = [
            'translator' => $this->translator,
        ];
        $isValidated =  $request->request->get('validated');
        $ressourceLocation = $isValidated ? $this->generateUrl('company_subscribed_index') : $this->generateUrl('company_registered_index');
        $request->request->remove('validated');

        $form = $this->createForm(CompanyAdminEditType::class, $company, $formOptions);
        $form->submit($request->request->all());
        if (!$form->isValid()) {
            return $form;
        }
        $this->entityManager->persist($company);
        $this->entityManager->flush($company);

        return View::create([], Response::HTTP_NO_CONTENT, ['Location' => $ressourceLocation]);
    }

    /**
     * @Rest\View()
     * @Rest\Post("admin/companies/{companyId}/validation")
     * @Security("is_granted('ROLE_UCOMPANY')")
     *
     * @return View
     */
    public function validateCompany(int $companyId, Request $request)
    {
        $company = $this->companyService->getCompany($companyId);

        if (!$company) {
            throw new EntityNotFoundException('Company with id ' . $companyId . ' does not exist!');
        }
        $companyStatut = $this->companyStatutService->getVALCompanyStatut()[0];

        $company->setCompanyStatut($companyStatut);

        $this->entityManager->persist($company);
        $this->entityManager->flush($company);


        $this->sendMail($company->getName());
        $ressourceLocation = $this->generateUrl('company_registered_index');
        return View::create([], Response::HTTP_NO_CONTENT, ['Location' => $ressourceLocation]);
    }

    //Méthode denvoie de mail
    public function sendMail($companyName)
    {
        $dsn = $this->getParameter('url');
        $transport = Transport::fromDsn($dsn);
        // $transport = Transport::fromDsn('smtp://karisalman@sakabay.com:sakabay2020@smtp.sakabay.com:587');
        $mailer = new Mailer($transport);

        $email = (new Email())
            ->from('no-reply@sakabay.com')
            ->to('salman.kari@docaposte.fr')
            ->addTo('andreasadelson@gmail.com')
            ->cc('andreasadelson@gmail.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('L\'Entreprise ' . $companyName . ' est inscrite avec succès ! ')
            ->text('Bonjour ' . $companyName . ' ,

            Veuilez ne pas répondre car ce mail est un envoie automatique

            Equipe Sakabay vous remercie d\'avance .')
            // ->html('<p>See Twig integration for better HTML integration!</p>')
        ;

        $mailer->send($email);
    }
    /**
     * @Rest\View()
     * @Rest\Delete("admin/companies/{companyId}")
     * @Security("is_granted('ROLE_DCOMPANY')")
     *
     * @return View
     */
    public function deleteCompany(int $companyId): View
    {
        try {
            $this->companyService->deleteCompany($companyId);
        } catch (EntityNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
        $ressourceLocation = $this->generateUrl('company_subscribed_index');

        return View::create([], Response::HTTP_NO_CONTENT, ['Location' => $ressourceLocation]);
    }

    /**
     * @Rest\View()
     * @Rest\Delete("admin/companies/{companyId}/decline")
     * @Security("is_granted('ROLE_DCOMPANY')")
     *
     * @return View
     */
    public function declineCompany(int $companyId): View
    {
        try {
            $this->companyService->deleteCompany($companyId);
        } catch (EntityNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
        $ressourceLocation = $this->generateUrl('company_registered_index');

        return View::create([], Response::HTTP_NO_CONTENT, ['Location' => $ressourceLocation]);
    }

    private function recastName(string $urlName): string
    {
        $urlName = str_replace(' ', '-', $urlName);
        $urlName = str_replace('\'', '', $urlName);
        $unwanted_array = array(
            'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
            'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y'
        );

        return $urlName = strtolower(strtr($urlName, $unwanted_array));
    }

    // private function getLongLat()
    // {
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, 'https://api-adresse.data.gouv.fr/search/?q=rue Julien sulbert 97350');
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //     $response = curl_exec($ch);

    //     // If using JSON...
    //     return json_decode($response);
    // }
}
