<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 22/11/17
 * Time: 11:54
 */

namespace AMRF\PublicRooterBundle\DataFixtures\ORM;


use AMRF\PublicRooterBundle\Entity\Company;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LoadCompany extends Fixture implements FixtureInterface
{
    public function load(ObjectManager $em)
    {
        $faker = Faker\Factory::create('fr_FR');

        $companies = [];
        $thematiques = array('culture', 'education', 'economie', 'mobilite', 'social');
        for ($i = 0; $i < 10; $i++) {
            $companies[$i] = new Company();
            $companies[$i]
                ->setName($faker->company)
                ->setAddress($faker->streetAddress)
                ->setZipCode($faker->postcode)
                ->setCity($faker->city)
                ->setActivities(serialize($faker->randomElements($thematiques, $count = 2)))
                ->setPresentation($faker->realText($maxNbChars = 1200, $indexSize = 2))
                ->setLogo($faker->imageUrl($width = 150, $height = 150))
                ->setUrl($faker->url)
                ->setLinkedin($faker->url)
                ->setFacebook($faker->url)
                ->setTwitter($faker->url)
                ->setContactFirstName($faker->name($gender = null))
                ->setContactLastName($faker->lastName)
                ->setContactEmail($faker->freeEmail)
                ->setContactPhone($faker->phoneNumber);


            $em->persist($companies[$i]);
            $this->setReference('company-' . $i, $companies[$i]);
        }
        $em->flush();
    }
}