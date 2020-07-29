<?php

namespace App\DataFixtures;

use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VehicleFixtures extends Fixture
{
    private const CAR = 'car';
    private const TRUCK = 'truck';

    public function load(ObjectManager $manager)
    {
        foreach (self::getVehicles() as $id => $data) {
            switch ($data['class']) {
                case self::CAR:
                case self::TRUCK:
                    $vehicle = new Vehicle($id, $data['manufacturer'], $data['model'], $data['class']);
                    break;
                default:
                    continue;
            }
            $manager->persist($vehicle);
            $this->addReference($id, $vehicle);
        }

        $manager->flush();
    }

    private static function getVehicles(): array
    {
        return [
            'clio' => [
                'class'        => self::CAR,
                'manufacturer' => 'Renault',
                'model'        => 'Clio 2',
                'seats'        => 5,
            ],
            'cox' => [
                'class'        => self::CAR,
                'manufacturer' => 'Volkswagen',
                'model'        => 'Coccinelle',
                'seats'        => 4,
            ],
            'polo' => [
                'class'        => self::CAR,
                'manufacturer' => 'Volkswagen',
                'model'        => 'Polo',
                'seats'        => 5,
            ],
            'ateam' => [
                'class'        => self::TRUCK,
                'manufacturer' => 'GMC',
                'model'        => 'Vandura',
                'load'         => 1000,
            ],
            'dumb' => [
                'class'        => self::TRUCK,
                'manufacturer' => 'Ford',
                'model'        => 'Econoline',
                'load'         => 600,
            ],
            'fear' => [
                'class'        => self::TRUCK,
                'manufacturer' => 'Corbitt',
                'model'        => '50SD6',
                'load'         => 5000,
            ],
        ];
    }
}
