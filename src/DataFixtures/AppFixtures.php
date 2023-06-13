<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Factory\NewsFactory;
use App\Factory\CategoryFactory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $fake;

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        $this->fake = Factory::create('pt_BR');
    }

    public function load(ObjectManager $manager): void
    {
        CategoryFactory::createMany(7);
        NewsFactory::createMany(1000, function () {
            return ['category' => CategoryFactory::random()];
        });

        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $manager->persist($user);

        $plaintextPassword = '123456789';

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );

        $user->setPassword($hashedPassword);

        for ($i = 0; $i < 11; $i++) {
            $user = new User();
            $user->setEmail($this->fake->email());
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);

            $plaintextPassword = uniqid();

            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );

            $user->setPassword($hashedPassword);
        }

        $manager->flush();
    }
}
