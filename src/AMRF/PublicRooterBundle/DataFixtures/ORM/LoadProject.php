<?php

namespace AMRF\PublicRooterBundle\DataFixtures\ORM;

use AMRF\PublicRooterBundle\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LoadProject extends Fixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $em
     */
    public function load(ObjectManager $em)
    {

        $faker = Faker\Factory::create('fr_FR');

        $projects = [];
        $thematiques = array('culture', 'education', 'economie', 'mobilite', 'social');
        $keyWords = array('ecole', 'periscolaire', 'medecin', 'sante', 'kebab');

        for ($i=0; $i < 10; $i++) {
            $projects[$i] = new Project();
            $projects[$i]->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true))
                ->setTheme(serialize($faker->randomElements($thematiques, $count = 1) ))
                ->setCreationDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
                ->setUpdateDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
                ->setImage($faker->imageUrl($width = 150, $height = 150))
                ->setProjectDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
                ->setProjectDuration($faker->randomElement($array = array (' 1mois','6mois','1 an', '100 ans')))
                ->setProjectCost($faker->numberBetween($min = 1000, $max = 50000))
                ->setProjectCoFinance($faker->randomElement($array = array (' oui','non')))
                ->setDescResume($faker->realText($maxNbChars = 200, $indexSize = 2))
                ->setDescContext($faker->realText($maxNbChars = 1200, $indexSize = 2))
                ->setDescGoal($faker->realText($maxNbChars = 200, $indexSize = 2))
                ->setDescProgress($faker->realText($maxNbChars = 800, $indexSize = 2))
                ->setDescPartners($faker->realText($maxNbChars = 200, $indexSize = 2))
                ->setDescResults($faker->realText($maxNbChars = 800, $indexSize = 2))
                ->setDescDifficulties($faker->realText($maxNbChars = 600, $indexSize = 2))
                ->setDescAdvices($faker->realText($maxNbChars = 200, $indexSize = 2))
                ->setContactName($faker->name($gender = null) )
                ->setContactOccupation($faker->jobTitle)
                ->setContactEmail($faker->freeEmail)
                ->setContactPhone($faker->phoneNumber)
                ->setFile($faker->fileExtension)
                ->setUrl($faker->url)
                ->setYoutube($faker->url)
                ->setFacebook($faker->url)
                ->setTwitter($faker->url)
                ->setKeywords(serialize($faker->randomElements($keyWords, $count = 3)))

            ;
            $em->persist($projects[$i]);
        }
        $em->flush();
    }

}