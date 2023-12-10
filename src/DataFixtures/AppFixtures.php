<?php

namespace App\DataFixtures;

use App\Factory\BookFactory;
use App\Factory\LibraryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        LibraryFactory::createMany(15, ['books' => BookFactory::new()->many(50)]);

        $manager->flush();
    }
}
