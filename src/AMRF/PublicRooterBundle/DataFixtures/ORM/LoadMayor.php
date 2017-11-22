<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 22/11/17
 * Time: 11:54
 */

namespace AMRF\PublicRooterBundle\DataFixtures\ORM;


use AMRF\PublicRooterBundle\Entity\Mayor;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LoadMayor extends Fixture implements FixtureInterface
{
    public function load(ObjectManager $em)
    {

        $faker = Faker\Factory::create('fr_FR');

        $mayors = [];
        for ($i = 0; $i < 10; $i++) {
            $mayors[$i] = new Mayor();
            $mayors[$i]
                ->setFirstName($faker->firstName($gender = null))
                ->setLastName($faker->lastName)
                ->setAddress($faker->streetAddress)
                ->setInsee($faker->numberBetween($min = 10000, $max = 99999))
                ->setEmail($faker->email)
                ->setPhone($faker->phoneNumber)
                ->setTown($faker->city)
                ->setZipCode($faker->postcode)
                ->setDepartment($faker->country)
                ->setRegion($faker->country)
                ->setLatitude($faker->latitude)
                ->setLongitude($faker->longitude)
                ->setPopulation($faker->numberBetween($min = 100, $max = 5000))
                ->setUrl($faker->url)
                ->setGoogle($faker->url)
                ->setFacebook($faker->url)
                ->setTwitter($faker->url);

            $em->persist($mayors[$i]);
            $this->setReference('mayor-' . $i, $mayors[$i]);
        }
        $em->flush();
    }
}