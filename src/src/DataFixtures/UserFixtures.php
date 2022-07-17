<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName("avgsf");
        $user->setLastName("fafcad");
        $user->setEmail("admin@gmail.com");

        $password = $this->hasher->hashPassword($user, '1234');
        $user->setPassword($password);

        $manager->persist($user);

        $user1 = new User();
        $user1->setFirstName("favadsf");
        $user1->setLastName("asvad");
        $user1->setEmail("rad@gmail.com");

        $password1 = $this->hasher->hashPassword($user1, '1234');
        $user1->setPassword($password1);

        $manager->persist($user1);

        $user2 = new User();
        $user2->setFirstName("bsfvas");
        $user2->setLastName("asvgvsfaad");
        $user2->setEmail("radmehr@gmail.com");

        $password2 = $this->hasher->hashPassword($user2, '1234');
        $user2->setPassword($password2);

        $manager->persist($user2);

        $hotel = new Hotel();
        $hotel->setName("Parsian Hotel");
        $hotel->setAddress("Azadi Square");
        $hotel->setCapacity(500);
        $hotel->setGrade(10);
        $hotel->setNumberOfRooms(200);
        $hotel->setPhoneNumber("019214");
        $hotel->setOwner($user1);
        $hotel->setEditor($user2);

        $manager->persist($hotel);

        $hotel1 = new Hotel();
        $hotel1->setName("Hilton Hotel");
        $hotel1->setAddress("Khosh");
        $hotel1->setCapacity(300);
        $hotel1->setGrade(2);
        $hotel1->setNumberOfRooms(100);
        $hotel1->setPhoneNumber("096674");
        $hotel1->setOwner($user1);
        $hotel1->setEditor($user2);

        $manager->persist($hotel1);
        $manager->flush();
    }
}