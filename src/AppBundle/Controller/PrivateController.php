<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 08/01/18
 * Time: 15:45
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use AppBundle\Entity\Dictionary;
use AppBundle\Entity\Project;
use AppBundle\Entity\Search;
use AppBundle\Service\SearchService;

use Doctrine\ORM\EntityManagerInterface;
use function is_null;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrivateController extends Controller
{
    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @param SearchService $searchService
     * @return Response
     */
    public function searchAction(Request $request, SearchService $searchService)
    {
        $search = new Search();
        $form = $this->createForm('AppBundle\Form\SearchType', $search);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if (!empty($request->query->get('texts'))){
            $result = $searchService->findByPertinence($search);
            if (!empty($result)) {
                $paginator = $this->get('knp_paginator');
                $results = $paginator->paginate(
                    $result,
                    $request->query->getInt('page', 1),
                    $request->query->getInt('limit', 10)
                );
                return $this->render('private/search.html.twig', [
                    'form' => $form->createView(),
                    'result' => $results,
                ]);
            } else {
                $this->addFlash(
                    'notice',
                    '<p>Aucun Resultat pour votre recherche.</p>'
                );
                return $this->render('private/search.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }


        if ($form->isSubmitted() && $form->isValid()) {
            $result = $searchService->findByPertinence($search);
            if (!empty($result)) {
                $paginator = $this->get('knp_paginator');
                $results = $paginator->paginate(
                    $result,
                    $request->query->getInt('page', 1),
                    $request->query->getInt('limit', 10)
                );
                return $this->render('private/search.html.twig', [
                    'form' => $form->createView(),
                    'result' => $results,
                ]);
            } else {
                $this->addFlash(
                    'notice',
                    '<p>Aucun Resultat pour votre recherche.</p>'
                );
                return $this->render('private/search.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        return $this->render('private/search.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/project/{slug}", name="sheet_project")
     * @param Project $project
     * @return Response
     */
    public function projetAction(Project $project)
    {
        $em = $this->getDoctrine()->getManager();
        $idUser = $this->getUser()->getId();
        $idProject = $project->getId();
        $favorites = $em->getRepository("AppBundle:Favorite")->getFavorite("project", $idProject, $idUser);
        (!empty($favorites) ? $favorie = 1 : $favorie = 0);
        return $this->render('private/projet.html.twig', array(
            'project' => $project,
            'favorite' => $favorie,
        ));
    }

    /**
     * @Route("/directory/{slug}", name="sheet_company")
     * @param Company $company
     * @return Response
     */
    public function companyAction(Company $company)
    {
        $em = $this->getDoctrine()->getManager();
        $idUser = $this->getUser()->getId();
        $idCompany = $company->getId();
        $favorites = $em->getRepository("AppBundle:Favorite")->getFavorite("company", $idCompany, $idUser);
        (!empty($favorites) ? $favorie = 1 : $favorie = 0);
        return $this->render('private/annuaire.html.twig', array(
            'company' => $company,
            'favorite' => $favorie,
        ));
    }

    /**
     * @Route("/directory", name="directory")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function partListeAction(Request $request, EntityManagerInterface $entityManager)
    {
        $em = $this->getDoctrine()->getManager();

        // REFACTORING SERVICE
        $userId = $this->getUser()->getId();
        $reposFavorite = $em->getRepository("AppBundle:Favorite");
        $favorites = $reposFavorite->getFavoriteToArray($userId);
        $reposCompany = $em->getRepository("AppBundle:Company");
        $companies = $reposCompany->findAll();
        $reposDictionary = $em->getRepository("AppBundle:Dictionary");
        $activities = $reposDictionary->findByType(Dictionary::TYPE_ACTIVITY);
        $queryBuilder = $em->getRepository('AppBundle:Company')
            ->createQueryBuilder('c');
        $filter['activity'] = [];
        $filter['alphabet'] = [];
        $cleanResult = [];
        if ($request->query->getAlnum('activity')) {
            $filter['activity'] = $request->query->getAlnum('activity');
            $activitiesArray = $request->query->getAlnum('activity');
            $results = [];
            foreach ($activitiesArray as $activity) {
                $sql = " SELECT id FROM company_activity WHERE activity = " . $activity;
                $stmt = $entityManager->getConnection()->prepare($sql);
                $stmt->execute();
                array_push($results, $stmt->fetchAll());
            }
            foreach ($results as $key => $companies) {
                foreach ($companies as $id) {
                    $cleanResult[] = $id["id"];
                }
            }
        }
        foreach ($cleanResult as $key => $resultCompany) {
            $queryBuilder
                ->orWhere('c.id = :id' . $key)
                ->setParameter('id' . $key, $resultCompany);
        }
        if ($request->query->getAlnum('alphabet')) {
            $filter['alphabet'] = $request->query->getAlnum('alphabet');
            $queryBuilder
                ->andwhere('c.name LIKE :name')
                ->setParameter('name', $request->query->getAlnum('alphabet') . '%');
        }
        $query = $queryBuilder->orderBy('c.name', 'ASC')->getQuery();
        //END REFACTORING
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );

        return $this->render('private/annuaire.html.twig', [
            "companies" => $result,
            "activities" => $activities,
            "favorites" => $favorites,
            "filter" => $filter,
        ]);
    }

}