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
        for ($i = 0; $i < count($thematiques); $i++) {
            $bdthema[$i] = new Dictionary();
            $value = strtolower(str_replace(" ", "", $thematiques[$i]));
            $bdthema[$i]
                ->setName($thematiques[$i])
                ->setType(Dictionary::TYPE_THEME)
                ->setValue($value);
            $em->persist($bdthema[$i]);
        }
        $em->flush();
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