<?php

namespace App\DataFixtures\ORM;

use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstName('test');
        $user->setRoles(['ROLE_USER_API']);
        $user->setEmail('test@test.su');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'test1'
        ));

        $token = new ApiToken($user);

        $manager->persist($token);
        $manager->persist($user);
        $manager->flush();
    }
}
