<?php

namespace App\Infrastructure\Doctrine\DataFixtures;

use App\Application\Utils\StringUtils;
use App\Domain\Model\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FixUtilisateur extends Fixture implements
    OrderedFixtureInterface,
    ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $fileCSV = $this->container->getParameter('app.fixture_csv_dir') . '/' .
            StringUtils::getNameFileCsvForLoad((new \ReflectionClass($this))->getShortName());

        $lines = file($fileCSV);

        foreach ($lines as $data) {
            list(
                $firstName,
                $lastName,
                $username,
                $password,
                $email,
            ) = explode(';', trim($data));

            $utilisateur = new Utilisateur();
            $utilisateur->setLastName($lastName);
            $utilisateur->setFirstName($firstName);
            $utilisateur->setUsername($username);
            $utilisateur->setEmail($email);
            $utilisateur->setPassword(password_hash($password, PASSWORD_BCRYPT));

            $manager->persist($utilisateur);
            $this->addReference('utilisateur_' . $username, $utilisateur);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture.
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
