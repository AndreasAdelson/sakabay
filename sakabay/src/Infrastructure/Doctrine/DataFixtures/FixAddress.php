<?php

namespace App\Infrastructure\Doctrine\DataFixtures;

use App\Application\Utils\StringUtils;
use App\Domain\Model\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FixAddress extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
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
                $postalAddress,
                $postalCode,
                $latitude,
                $longitude
            ) = explode(';', trim($data));

            $address = new Address();
            $address->setPostalAddress($postalAddress);
            $address->setPostalCode($postalCode);
            $address->setLatitude($latitude);
            $address->setLongitude($longitude);
            $manager->persist($address);
            $this->addReference('address_' . $postalAddress, $address);
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
