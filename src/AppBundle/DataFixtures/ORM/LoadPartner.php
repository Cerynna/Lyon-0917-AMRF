<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 22/11/17
 * Time: 11:54
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Partner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LoadPartner extends Fixture implements FixtureInterface
{
    public function load(ObjectManager $em)
    {

        $faker = Faker\Factory::create('fr_FR');

        $partners = [];
        for ($i = 0; $i < LoadUser::MAX_USER; $i++) {
            $partners[$i] = new Partner();
            $partners[$i]
                ->setFirstName($faker->firstName($gender = null))
                ->setLastName($faker->lastName)
                ->setOccupation($faker->jobTitle)
                ->setEmail($faker->email)
                ->setPhone($faker->phoneNumber)
                ->setCompany($this->getReference('company-' . $i));

            $em->persist($partners[$i]);

            $this->setReference('partner-' . $i, $partners[$i]);
        }
        $em->flush();
    }
}