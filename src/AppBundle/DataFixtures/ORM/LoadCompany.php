<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Company;

use AppBundle\Service\SlugService;
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
        for ($i = 0; $i < LoadUser::MAX_USER; $i++) {
            $companies[$i] = new Company();
			$slugificator = new SlugService();
			$name = $faker->company;
            $companies[$i]
                ->setName($name)
				->setSlug($slugificator->slug($name))
                ->setAddress($faker->streetAddress)
                ->setZipCode($faker->postcode)
                ->setCity($faker->city)
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