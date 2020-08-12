<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        // Create Admin
        $admin = new User();
        $admin->setEmail('admin@mail.ru');
        $admin->setPassword(
            $this->passwordEncoder->encodePassword(
                $admin,
                'admin'
            )
        );
        $admin->setName('Admin');
        $admin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);
        // Create User
        $user = new User();
        $user->setEmail('user@mail.ru');
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                'user'
            )
        );
        $user->setName('User');
        $user->setRoles(["ROLE_USER"]);
        $manager->persist($user);

        $manager->flush();
    }
}
