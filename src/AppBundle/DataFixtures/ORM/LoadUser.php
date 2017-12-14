<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 22/11/17
 * Time: 11:54
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUser extends Fixture implements FixtureInterface, ContainerAwareInterface
{
    const MAX_USER = 20;
    public function load(ObjectManager $em)
    {
        $faker = Faker\Factory::create('fr_FR');

        $roles = array(User::USER_ROLE_MAYOR, User::USER_ROLE_PARTNER);
        $status = array(User::USER_STATUS_ACTIF, User::USER_STATUS_INACTIF);

        $users = [];

        $role = $faker->randomElement($roles);
        $insee = $faker->numberBetween($min = 10000, $max = 99999);

        $encoder = $this->container->get('security.password_encoder');

        $admin = new User();
         $admin
            ->setLogin("admin")
            ->setPassword($encoder->encodePassword($admin, "admin"))
            ->setRole(3)
            ->setStatus($faker->randomElement($status))
            ->setEmail($faker->email)
            ->setCreationDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
            ->setLastLogin($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()));
        $em->persist($admin);

        for ($i = 0; $i < self::MAX_USER; $i++) {
            $users[$i] = new User();
            $role = $faker->randomElement($roles);
            $insee = $faker->numberBetween($min = 10000, $max = 99999);
            $users[$i]
                ->setLogin($insee)
                ->setPassword($encoder->encodePassword($admin, $faker->password))
                ->setRole($role)
                ->setStatus($faker->randomElement($status))
                ->setEmail($faker->email)
                ->setCreationDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
                ->setLastLogin($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
                ->setMayor($this->getReference('mayor-' . $i));
            $em->persist($users[$i]);
        }
        for ($i = 0; $i < self::MAX_USER; $i++) {
            $users[$i] = new User();
            $role = $faker->randomElement($roles);
            $insee = $faker->numberBetween($min = 10000, $max = 99999);
            $users[$i]
                ->setLogin($insee)
                ->setPassword($encoder->encodePassword($admin, $faker->password))
                ->setRole($role)
                ->setStatus($faker->randomElement($status))
                ->setEmail($faker->email)
                ->setCreationDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
                ->setLastLogin($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
                ->setPartner($this->getReference('partner-' . $i));

            $em->persist($users[$i]);
        }

        $em->flush();
    }

    public function getDependencies()
    {
        return array(
            LoadMayor::class,
            LoadPartner::class,
        );
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}