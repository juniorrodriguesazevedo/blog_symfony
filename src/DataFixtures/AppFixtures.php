<?php

namespace App\DataFixtures;

use App\Factory\NewsFactory;
use App\Factory\CategoryFactory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CategoryFactory::createMany(7);
        NewsFactory::createMany(200, function() {
            return [ 'category' => CategoryFactory::random()];
        });

        $manager->flush();
    }
}
