<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Mayor;
use AppBundle\Entity\Partner;
use AppBundle\Entity\Project;

use AppBundle\Entity\User;
use AppBundle\Service\SlugService;
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
        $thematiques = ['Education',
            'Aménagement du territoire',
            'Culture',
            'Démocratie Local',
            'Eau et assainissement',
            'Economie',
            'Environnement',
            'Mobilité',
            'Numérique',
            'Relations internationales',
            'Santé',
            'Services de proximité',
            'Social',
            'Tourisme',

        ];
        $keywords = ['application',
            'Arménie',
            'CCAS',
            'cérémonie',
            'cinema',
            'commerces',
            'Coopération décentralisée',
            'crèche',
            'développement durable',
            'digital',
            'école',
            'écologie',
            'economie sociale et solidaire',
            'église',
            'EHPAD',
            'élections',
            'emploi',
            'entreprises',
            'espace de coworking',
            'espaces verts',
            'Etat civil',
            'Europe',
            'festival',
            'formation',
            'haut débit',
            'infirmiers',
            'innovation',
            'intermodalités',
            'internet',
            'Jumelage',
            'lecture',
            'logements sociaux',
            'maison de santé',
            'maison de services publics',
            'maisons de quartier',
            'manifestations citoyennes',
            'médecin',
            'musique',
            'parcs régionaux',
            'patrimoine',
            'périscolaire',
            'professionnels de santé',
            'rénovation/réfection',
            'réseaux',
            'restauration scolaire',
            'SPANC',
            'startups',
            'Station d\'épuration ',
            'station service',
            'téléphonie fixe',
            'téléphonie mobile',
            'télétravail ',
            'théâtre',
            'transports',
            'transports',
            'urbanisme',
            'valorisation du territoire',
            'vie associative',
            'voies navigables',
            'voirie',
        ];
        for ($i = 0; $i < LoadUser::MAX_USER; $i++) {
            $projects[$i] = new Project();

            $nbimage = rand(1,4);
            $dbimage = [];
            $imagefaker = $dbimage;
			$slugificator = new SlugService();
			$title = $faker->sentence($nbWords = 6, $variableNbWords = true);
			$updateDate = $faker->dateTimeBetween($startDate = '-30 month', $endDate = 'now', $timezone = null);
            $projects[$i]
                ->setStatus(1)
                ->setTitle($title)



                ->setCreationDate($faker->dateTimeBetween($startDate = '-30 month', $endDate = $updateDate, $timezone = null))
                ->setUpdateDate($updateDate)


                ->setImages($imagefaker)
				->setSlug($slugificator->slug($title))

				->setProjectDate($faker->dateTimeBetween($startDate = '-30 month', $endDate = 'now', $timezone = null))
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


                ->setMayor($this->getReference('mayor-' . $i));
            $em->persist($projects[$i]);
        }


        $em->flush();
    }


}
