<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 23/11/17
 * Time: 21:38
 */


namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Dictionary;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDictionary extends Fixture implements FixtureInterface
{
    public function load(ObjectManager $em)
    {


        $bdthema = [];
        $bdsecteur = [];
        $bdkey = [];
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
        $secteur = ['Alimentation',
            'Assurance',
            'Banque',
            'Collectivité',
            'Commerce',
            'Déchets',
            'Démocratie locale',
            'Développement local',
            'Économie',
            'Éducation',
            'Énergie',
            'Équipement',
            'Finances',
            'Formation',
            'Internet',
            'Numérique',
            'Santé',
            'Services publics',
            'Social',
            'Téléphonie',
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

        for ($i = 0; $i < count($keywords); $i++) {
            $bdkey[$i] = new Dictionary();
            $value = strtolower(str_replace(" ", "", $keywords[$i]));
            $bdkey[$i]
                ->setName($keywords[$i])
                ->setType(Dictionary::TYPE_KEYWORD)
                ->setValue($value);
            $em->persist($bdkey[$i]);
        }

        for ($i = 0; $i < count($thematiques); $i++) {
            $bdthema[$i] = new Dictionary();
            $value = strtolower(str_replace(" ", "", $thematiques[$i]));
            $bdthema[$i]
                ->setName($thematiques[$i])
                ->setType(Dictionary::TYPE_THEME)
                ->setValue($value);
            $em->persist($bdthema[$i]);
        }

        for ($i = 0; $i < count($secteur); $i++) {
            $bdsecteur[$i] = new Dictionary();
            $value = strtolower(str_replace(" ", "", $secteur[$i]));
            $bdsecteur[$i]
                ->setName($secteur[$i])
                ->setType(Dictionary::TYPE_ACTIVITY)
                ->setValue($value);
            $em->persist($bdsecteur[$i]);
        }
        $em->flush();


    }
}