<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Association;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    private $userPasswordHasher;

    public function __construct(
        UserPasswordHasherInterface $userPasswordHasher
    ) {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Création de l'utilisateur administrateur
        $user = new User;

        $hash = $this->userPasswordHasher->hashPassword($user, "123456789");

        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword($hash);
        $user->setIsVerified(true);
        $user->setEmail('aka.sk3ud@gmail.com');
        $user->setPseudo('SK3uD');
        $user->setImageName('monavatar-gros-plan-5f9d92d992af6565934594-60a149eaa5a18699397380-624c824a434e0863564470.jpg');
        $user->setFirstname('David');
        $user->setLastname('Skeud');
        $user->setTelephone($faker->e164PhoneNumber);
        $user->setAddress($faker->streetAddress);
        $user->setPostalCode($faker->postcode);
        $user->setCity($faker->city);

        $manager->persist($user);
        $manager->flush();

        for ($i = 0; $i < mt_rand(30, 100); $i++) {
            $member = new User;

            $isVerified = mt_rand(0,1) == 1 ? true : false;

            $hash = $this->userPasswordHasher->hashPassword($user, "123456789");

            $member->setRoles(["ROLE_USER"]);
            $member->setIsVerified($isVerified);
            $member->setPassword($hash);
            $member->setEmail($faker->email);
            $member->setPseudo($faker->userName);
            $member->setFirstname($faker->firstName);
            $member->setLastname($faker->lastName);
            $member->setTelephone($faker->e164PhoneNumber);
            $member->setAddress($faker->streetAddress);
            $member->setPostalCode($faker->postcode);
            $member->setCity($faker->city);

            $manager->persist($member);
        }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
