<?php

namespace App\Infrastructure\Doctrine\DataFixtures;

use App\Application\Utils\StringUtils;
use App\Domain\Model\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FixRole extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
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
            list($code, $name, $fonctions) = explode(';', trim($data));

            $role = new Role();
            $role->setCode($code);
            $role->setName($name);

            $listFonctions = explode('|', $fonctions);
            foreach ($listFonctions as $itemFonction) {
                if ('' !== $itemFonction) {
                    $role->addFonction($this->getReference('fonction_' . $itemFonction));
                }
            }

            $manager->persist($role);
            $this->addReference('role_' . $code, $role);
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
        return 2;
    }
}
