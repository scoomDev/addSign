<?php

namespace App\DataFixtures;

use App\Entity\Department;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
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
        $faker = Factory::create();

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

        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setEmail($faker->safeEmail)
                ->setPassword($this->encoder->encodePassword($user, 'password'))
                ->setDepartment($department)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setPhoneNumber($faker->phoneNumber)
                ->setCreatedAt(new \DateTime())
                ->setRoles(['ROLE_USER'])
                ->setFunction($faker->jobTitle);
            $manager->persist($user);
        }

        $manager->flush();
    }
}