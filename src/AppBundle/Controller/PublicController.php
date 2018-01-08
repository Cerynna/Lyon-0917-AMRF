<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Company;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Dictionary;
use AppBundle\Entity\Favorite;
use AppBundle\Entity\Project;
use AppBundle\Entity\Search;
use AppBundle\Service\EmailService;
use AppBundle\Service\SearchService;


use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use SensioLabs\Security\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Component\Filesystem\Filesystem;


class PublicController extends Controller
{

	/**
	 * @Route("/", name="home")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

        /** Change that is a real code for Update LastLogin */
        $user = $this->getUser();
        if (is_object($user)) {
            $lastloginDB = $user->getLastLogin();
            $today = new \DateTime('now');
            $tomorow = $today->modify('+1 day');
            if ($tomorow <= $lastloginDB) {
                $user->setLastLogin($today);
                $em->flush();
            }
        }
        /** ------------------------------------------------ */

        $projects = $em->getRepository('AppBundle:Project')->getLastProject();
        $array = ["main-1", "main-2"];
        $contents = $em->getRepository('AppBundle:PublicPage')->getContentIndex($array);


        return $this->render('public/index.html.twig', array(
            'projects' => $projects,
            'contents' => $contents,
        ));
    }

    /**
     * @Route("/amrf", name="amrf")
     */
    public function amrfAction()
    {
        $em = $this->getDoctrine()->getManager();
        $array = ["amrf-1", "amrf-2", "amrf-3"];
        $contents = $em->getRepository('AppBundle:PublicPage')->getContentIndex($array);

        return $this->render('public/amrf.html.twig', array(
            'contents' => $contents,
        ));
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request, EmailService $emailService)
    {
        $contact = new Contact();
        $form = $this->createForm('AppBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $this->captchaverify($request->get('g-recaptcha-response'))) {
            $message = [
                'to' => 'wcsprojetmaire@gmail.com',
                'from' => $contact->getEmail(),
                'type' => EmailService::TYPE_MAIL_CONTACT_ADMIN['key'],
                'name' => $contact->getName(),
                'firstName' => $contact->getFirstName(),
                'statut' => $contact->getStatut(),
                'phone' => $contact->getPhone(),
                'object' => $contact->getSubject(),
                'message' => $contact->getMessage(),
            ];
            $emailService->sendEmail($message);

            $messageconfirm = [
                'to' => $contact->getEmail(),
                'type' => EmailService::TYPE_MAIL_CONTACT_CONFIRM['key'],
                'object' => $contact->getSubject(),
                'message' => $contact->getMessage(),
            ];
            $emailService->sendEmail($messageconfirm);

            $this->addFlash(
                'notice',
                'Votre message a bien été envoyé'
            );

            return $this->redirectToRoute('home');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'notice',
                'Votre message n\'a pas été envoyé, veuillez compléter le formulaire'
            );

        } elseif ($form->isSubmitted() && !$this->captchaverify($request->get('g-recaptcha-response'))) {
            $this->addFlash(
                'notice',
                '<p>Votre message n\'a pas été envoyé,</p><p>veuillez remplir le CAPTCHA</p>'
            );

        }

        return $this->render('public/contact.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/confidential", name="confidential")
     */
    public function confidentialAction()
    {
        $em = $this->getDoctrine()->getManager();
        $array = ["cgu"];
        $contents = $em->getRepository('AppBundle:PublicPage')->getContentIndex($array);

        return $this->render('public/confidential.html.twig', array(
            'contents' => $contents,
        ));
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $array = ["ml"];
        $contents = $em->getRepository('AppBundle:PublicPage')->getContentIndex($array);

        return $this->render('public/mentions.html.twig', array(
            'contents' => $contents,
        ));
    }


    //PARTIE PRIVE

    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request, SearchService $searchService)
    {
        $search = new Search();
        $form = $this->createForm('AppBundle\Form\SearchType', $search);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();


        if ($form->isSubmitted() && $form->isValid()) {

            $themas = [];
            foreach ($search->getThemas() as $thematique) {
                $themas[] = $thematique->getId();
            }
            $keywords = [];
            foreach ($search->getKeywords() as $keyword) {
                $keywords[] = $keyword->getId();
            }

            $finder['table'] = 'project';
            if (!empty($search->getTexts())) {
                $finder['texts'] = $search->getTexts();
            }
            if (!empty($themas)) {
                $finder['themas'] = $themas;
            }
            if (!empty($keywords)) {
                $finder['keywords'] = $keywords;
            }
            if (!empty($search->getCommune())) {
                $finder['localisation'][Project::LOCALISATION_COMMUNE] = $search->getCommune();
            }
            if (!empty($search->getDepartement())) {
                $finder['localisation'][Project::LOCALISATION_DEPARTEMENT] = $search->getDepartement();
            }
            if (!empty($search->getRegion())) {
                $finder['localisation'][Project::LOCALISATION_REGION] = $search->getRegion();
            }

            $result = $searchService->findByPertinence($finder);
            /**
             * @var $paginator \Knp\Component\Pager\Paginator
             */
            $paginator = $this->get('knp_paginator');
            $resultats = $paginator->paginate(
                $result,
                $request->query->getInt('page', 1),
                $request->query->getInt('limit', 10)
            );


            return $this->render('private/search.html.twig', [
                'result' => $resultats,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('private/search.html.twig', [
            'form' => $form->createView(),
        ]);
    }

	/**
	 * @Route("/project/{slug}", name="sheet_project")
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
     * @Route("/directory", name="directory")
     */
    public function partListeAction(Request $request, EntityManagerInterface $entityManager)
    {
        $em = $this->getDoctrine()->getManager();

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
                ->orWhere('c.id = :id'.$key)
                ->setParameter('id'.$key, $resultCompany);
        }


        if ($request->query->getAlnum('alphabet')) {
            $filter['alphabet'] = $request->query->getAlnum('alphabet');
            $queryBuilder
                ->andwhere('c.name LIKE :name')
                ->setParameter('name', $request->query->getAlnum('alphabet') . '%');

        }
        $query = $queryBuilder->orderBy('c.name', 'ASC')->getQuery();

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
            "filter" => $filter,
        ]);


    }

    //PARTIE ADMIN

    /**
     * @Route("/admin/", name="admin_index")
     */
    public function adminIndexAction()
    {
        return $this->render('private/admin/adminIndex.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('public/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }

	/**
	 * @Route("/addFavorite/{type}/{idType}", name="addFavorite")
	 */

	public function addFavorite(Request $request, $type, $idType)
	{

		$idUser = $this->get('security.token_storage')->getToken()->getUser();

		$favorite = new Favorite();

		$favorite->setUser($idUser);

		if ($request->isXmlHttpRequest()) {
		$em = $this->getDoctrine()->getManager();

		if ($type == "project") {
			$project = $this->getDoctrine()->getRepository("AppBundle:Project")->projectById($idType);

			$favorite->setProject($project[0]);
			$favorite->setCompany(null);
		}
		if ($type == "company") {
			$company = $this->getDoctrine()->getRepository("AppBundle:Company")->companyById($idType);

			$favorite->setCompany($company[0]);
			$favorite->setProject(null);
		}

		$em->persist($favorite);
/*		dump($favorite);*/
		$em->flush();

		return new Response("Favorie Ajouté ");

		} else {
			throw new HttpException(500, 'Invalid call');
		}

	}

	/**
	 * @Route("/delFavorite/{type}/{idType}", name="delFavorite")
	 */
	public function delFavorite(Request $request, $type, $idType)
	{
		$idUser = $this->getUser();

		if ($request->isXmlHttpRequest()) {
			$em = $this->getDoctrine()->getManager();
			$favoris = $em->getRepository("AppBundle:Favorite")->getFavorite($type, $idType, $idUser->getId());
			dump($favoris);
			$em->remove($favoris[0]);

			$em->flush();

			return new Response("Favorie Suprrimé ");
		} else {
			throw new HttpException(500, 'Invalid call');
		}
	}


    /**
     * @Route("/deletefile/{fileName}", name="deletefile")
     */
    public function deleteFileAction(Request $request, $fileName)
    {

        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            $imageDelete = str_replace("-", "/", $fileName);
            $imgExplode = explode('/', $imageDelete);
            $project = $em->getRepository(Project::class)->find($imgExplode[2]);

            if ($imgExplode[1] == "project") {
                if ($imgExplode[3] == 'photos') {
                    $imagesInDB = $em->getRepository('AppBundle:Project')->getImageProject($imgExplode[2]);
                    $newImagesDB = [];
                    foreach ($imagesInDB[0]['images'] as $imageInDB) {
                        if ($imgExplode[4] != $imageInDB) {
                            $newImagesDB[] = $imageInDB;
                        }
                    }
                    $project->setImages($newImagesDB);

                } elseif ($imgExplode[3] == 'file') {
                    $project = $em->getRepository(Project::class)->find($imgExplode[2]);
                    $project->setFile('');
                }
                $em->flush();
                $fs = new Filesystem();
                $fs->remove($imageDelete);
            }

            if ($imgExplode[1] == "company") {
                $company = $em->getRepository(Company::class)->find($imgExplode[2]);
                $company->setLogo('');
            }
            $em->flush();
            $fs = new Filesystem();
            $fs->remove($imageDelete);

            return new Response("Image supprimer " . $imageDelete . " - " . count($imageDelete) . " - " . $imgExplode[4]);
        } else {
            throw new HttpException('500', 'Invalid call');
        }

    }

    public function captchaverify($recaptcha)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            "secret" => "6LfGgDYUAAAAAJw5_bYZMgSV1S5zhy4SZByMZ9G0", "response" => $recaptcha));
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);

        return $data->success;
    }
}