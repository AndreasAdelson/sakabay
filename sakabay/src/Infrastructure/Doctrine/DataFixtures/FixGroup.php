<?php

namespace App\Infrastructure\Doctrine\DataFixtures;

use App\Application\Utils\StringUtils;
use App\Domain\Model\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FixGroup extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
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
            list($code, $name, $roles, $users) = explode(';', trim($data));

            $group = new Group();
            $group->setCode($code);
            $group->setName($name);

            $listRoles = explode('|', $roles);
            $listUsers = explode('|', $users);
            foreach ($listRoles as $itemRole) {
                if ('' !== $itemRole) {
                    $group->addRole($this->getReference('role_' . $itemRole));
                }
            }
            foreach ($listUsers as $itemUser) {
                if ('' !== $itemUser) {
                    $group->addUtilisateur($this->getReference('utilisateur_' . $itemUser));
                }
            }

            $manager->persist($group);
            $this->addReference('group_' . $code, $group);
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
        return 3;
    }
}
