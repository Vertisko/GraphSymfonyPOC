<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach (self::getAnimals() as $id => $data) {

            $animal = new Animal($id, $data['name']);
            $manager->persist($animal);
            $this->addReference($id, $animal);
        }

        $manager->flush();
    }

    private static function getAnimals(): array
    {
        return [
            'rintintin' => [
                'class' => 'Animal',
                'name' => 'Rintintin',
            ],
            'felix' => [
                'class' => 'AppAnimal',
                'name' => 'Felix',
            ],
            'baloo' => [
                'class' => 'Animal',
                'name' => 'Baloo',
            ],
        ];
    }
}
