<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Mayor;
use AppBundle\Entity\Partner;
use AppBundle\Entity\Project;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;


class LoadProject extends Fixture implements FixtureInterface
{


    public function load(ObjectManager $em)
    {

        $faker = Faker\Factory::create('fr_FR');

        $projects = [];
        $thematiques = array('culture', 'education', 'economie', 'mobilite', 'social');
        $keywords = array('ecole', 'periscolaire', 'medecin', 'sante', 'kebab');
        for ($i = 0; $i < LoadUser::MAX_USER; $i++) {
            $projects[$i] = new Project();
            $projects[$i]
                ->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true))
                ->setTheme(serialize($faker->randomElements($thematiques, $count = 3)))
                ->setCreationDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
                ->setUpdateDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
                ->setImage($faker->imageUrl($width = 150, $height = 150))
                ->setProjectDate($faker->dateTime($max = 'now', $timezone = date_default_timezone_get()))
                ->setProjectDuration($faker->randomElement($array = array('1 mois', '6 mois', '1 ans', '100 ans')))
                ->setProjectCost($faker->numberBetween($min = 1000, $max = 50000))
                ->setProjectCoFinance($faker->randomElement($array = array('Oui', 'Non')))
                ->setDescResume($faker->realText($maxNbChars = 200))
                ->setDescContext($faker->realText($maxNbChars = 1200, $indexSize = 2))
                ->setDescGoal($faker->realText($maxNbChars = 200, $indexSize = 2))
                ->setDescProgress($faker->realText($maxNbChars = 800, $indexSize = 2))
                ->setDescPartners($faker->realText($maxNbChars = 200, $indexSize = 2))
                ->setDescResults($faker->realText($maxNbChars = 800, $indexSize = 2))
                ->setDescDifficulties($faker->realText($maxNbChars = 600, $indexSize = 2))
                ->setDescAdvices($faker->realText($maxNbChars = 200, $indexSize = 2))
                ->setContactName($faker->name($gender = null))
                ->setContactOccupation($faker->jobTitle)
                ->setContactEmail($faker->freeEmail)
                ->setContactPhone($faker->phoneNumber)
                ->setFile($faker->fileExtension)
                ->setUrl($faker->url)
                ->setYoutube($faker->url)
                ->setFacebook($faker->url)
                ->setTwitter($faker->url)
                ->setKeyWords(serialize($faker->randomElements($keywords, $count = 3)))
                ->setMayor($this->getReference('mayor-' . $i));
            $em->persist($projects[$i]);
        }


        $em->flush();
    }

}