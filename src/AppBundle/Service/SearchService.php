<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 04/01/18
 * Time: 09:43
 */


namespace AppBundle\Service;


use AppBundle\Entity\Company;
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

    public function findByPertinence($array)
    {
        $repo = $this->em->getRepository("AppBundle:Project");
            $results = [];
            if (isset($array['texts'])) {
                $resultsText = $repo->findByTextPertinence($array['texts'], ProjectRepository::CHAMPS);
                dump($resultsText);
                $results = array_merge($results, $resultsText);
            }
            if (isset($array['themas'])) {
                $resultThema = $repo->findByThemaPertinence($array['themas']);
                dump($resultThema);
                $results = array_merge($results, $resultThema);
            }
            if (isset($array['keywords'])) {
                $resultKeywords = $repo->findByKeywordPertinence($array['keywords']);
                dump($resultKeywords);
                $results = array_merge($results, $resultKeywords);
            }

            if (isset($array['localisation'])) {
                $resultLocalisation = $repo->findByLocalisationPertinence($array['localisation']);
                dump($resultLocalisation);
                $clearLocation = $repo->arrayCleaner($resultLocalisation);
                $resultsClear = "";
                if (!empty($results)) {
                    foreach ($results[0] as $arrayID) {
                        if (in_array($arrayID['id'], $clearLocation)) {
                            $resultsClear[] = array_merge([], [$arrayID]);

                        }
                    }
                    $results = $resultsClear;
                } else {
                    $results = array_merge($results, $resultLocalisation);
                }
            }
            $arrayIDs = [];
            if (!empty($results)) {
                foreach ($results as $arrayID) {
                    foreach ($arrayID as $key => $idUnique) {
                        if (array_key_exists($idUnique["id"], $arrayIDs)) {
                            $arrayIDs[$idUnique["id"]] = $arrayIDs[$idUnique["id"]] + 1;
                        } else {
                            $arrayIDs[$idUnique["id"]] = 1;
                        }

                    }
                }
                arsort($arrayIDs);
                $projectByPertinence = [];
                $i = 0;
                foreach ($arrayIDs as $id => $nbResult) {
                    $projectByPertinence[$i][$array['table']] = $repo->projectById($id);
                    $projectByPertinence[$i]['nb'] = $nbResult;

                    $i++;
                }
                return $projectByPertinence;
            } else {
                return false;
            }
        }

}