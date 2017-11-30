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
        $thematiques = array('Education',
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

        );
        for ($i = 0; $i < count($thematiques); $i++) {
            $bdthema[$i] = new Dictionary();
            $value = strtolower(str_replace(" ", "", $thematiques[$i]));
            $bdthema[$i]
                ->setName($thematiques[$i])
                ->setType(1)
                ->setValue($value);


            $em->persist($bdthema[$i]);

        }
        $em->flush();


    }
}