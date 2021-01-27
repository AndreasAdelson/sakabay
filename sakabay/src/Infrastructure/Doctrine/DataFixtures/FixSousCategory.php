<?php

namespace App\Infrastructure\Doctrine\DataFixtures;

use App\Application\Utils\StringUtils;
use App\Domain\Model\SousCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FixSousCategory extends Fixture implements
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
                $code,
                $name,
                $category
            ) = explode(';', trim($data));

            $sousCategory = new SousCategory();
            $sousCategory->setCode($code);
            $sousCategory->setName($name);
            $sousCategory->setCategory($this->getReference('category_' . $category));

            $manager->persist($sousCategory);
            $this->addReference('sousCategory_' . $code, $sousCategory);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}
