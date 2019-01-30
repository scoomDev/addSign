<?php

namespace App\DataFixtures;

use App\Entity\Department;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $department = new Department();
        $department->setName('adct')
            ->setFirstColor('#FFFFFF')
            ->setSecondaryColor('#FFD100')
            ->setTextColor('#1D1D1D')
            ->setLinkedin('https://linkedin.fr')
            ->setInstagram('https://instagram.fr');
        $manager->persist($department);

        $user = new User();
        $user->setEmail('csoetaert@addictic.fr')
            ->setPassword($this->encoder->encodePassword($user, '123456789'))
            ->setDepartment($department)
            ->setFirstname('Christopher')
            ->setLastname('Soetaert')
            ->setPhoneNumber('0247362196')
            ->setCreatedAt(new \DateTime())
            ->setRoles(['ROLE_SUPER_ADMIN'])
            ->setFunction('Super Admin');
        $manager->persist($user);

        // TODO : add Faker
//        for ($i = 0; $i < 50; $i++) {
//
//        }

        $manager->flush();
    }
}