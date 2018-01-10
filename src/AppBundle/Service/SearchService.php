<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 04/01/18
 * Time: 09:43
 */


namespace AppBundle\Service;


use AppBundle\Entity\Company;
use AppBundle\Entity\Project;
use AppBundle\Entity\Search;
use AppBundle\Repository\CompanyRepository;
use AppBundle\Repository\ProjectRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class SearchService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function findByPertinence(Search $array)
    {
        $result = [];
        $repo = $this->em->getRepository("AppBundle:Project");
        if (!is_null($array->getTexts())) {
            $result = array_merge(
                $result,
                $repo->findByTextPertinence($array->getTexts(), ProjectRepository::CHAMPS)
            );
        }
        if (count($array->getThemas()) != 0) {
            $result = array_merge(
                $result,
                $repo->findByThemaPertinence($array->getThemas())
            );
        }
        if (count($array->getKeywords()) != 0) {
            $result = array_merge(
                $result,
                $repo->findByKeywordPertinence($array->getKeywords())
            );
        }
        if (!is_null($array->getRegion()) OR !is_null($array->getDepartement()) OR !is_null($array->getCommune())) {
            $result = array_merge(
                $result,
                $repo->findByLocalisationPertinence($array->getRegion(), $array->getDepartement(), $array->getCommune())
            );
        }

        $resultFinal = $repo->finalPertinence($this->counterArray($result));

        return $resultFinal;

    }

    public function counterArray($array)
    {
        $arrayIDs = [];
        foreach ($array as $idUnique) {
            if (array_key_exists($idUnique, $arrayIDs)) {
                $arrayIDs[$idUnique] = $arrayIDs[$idUnique] + 1;
            } else {
                $arrayIDs[$idUnique] = 1;
            }
        }
        arsort($arrayIDs);
        return $arrayIDs;

    }
}