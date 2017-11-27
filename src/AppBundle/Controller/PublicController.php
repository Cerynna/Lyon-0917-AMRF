<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Mayor;
use AppBundle\Entity\Partner;
use AppBundle\Entity\Company;
use AppBundle\Entity\Project;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends Controller
{

    //PARTIE PUBLIC


    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('public/index.html.twig');
    }

    /**
     * @Route("/amrf", name="amrf")
     */
    public function amrfAction()
    {
        return $this->render('public/amrf.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('public/contact.html.twig');
    }

    /**
     * @Route("/confidential", name="confidential")
     */
    public function confidentialAction()
    {
        return $this->render('public/confidential.html.twig');
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentionsAction()
    {
        return $this->render('public/mentions.html.twig');
    }


    //PARTIE PRIVE

    /**
     * @Route("/search", name="recherche")
     */
    public function searchAction()
    {
        return $this->render('private/search.html.twig');
    }

    /**
     * @Route("/projet", name="projet")
     */
    public function projetAction()
    {
        return $this->render('private/projet.html.twig');
    }

    /**
     * @Route("/annuaire/", name="annuaire")
     */
    public function partListeAction()
    {
        return $this->render('private/annuaire.html.twig');
    }

    /**
     * @Route("/favoris", name="favoris")
     */
    public function partFavorisAction()
    {
        return $this->render('private/favoris.html.twig');
    }
    //PARTIE MAIRE

    /**
     * @Route("/maire/profil", name="maireProfil")
     */
    public function maireProfilAction(Request $request)
    {
        $mayor = new Mayor();
        $form = $this->createForm('AppBundle\Form\MayorType', $mayor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mayor);
            $em->flush();

            return $this->redirectToRoute('admin_mayor_show', array('id' => $mayor->getId()));
        }

        return $this->render('private/maires/maireProfil.html.twig', array(
            'mayor' => $mayor,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/maire", name="maireHome")
     */
    public function maireIndexAction()
    {
        return $this->render('private/maires/maireIndex.html.twig');
    }

    /**
     * @Route("/maire/projet", name="maireProjets")
     */
    public function maireProjetAction()
    {
        return $this->render('private/maires/maireProjet.html.twig');
    }

    /**
     * @Route("/maire/projet/new", name="maireFormProjet")
     */
    public function mairesFormProjetAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm('AppBundle\Form\ProjectType', $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $theme = $project->getTheme();
            $dbthema = [];
            foreach ($theme as $key => $value) {

                $dbthema[] = $value->getValue();
            }
            $themes = serialize($dbthema);
            $project->setTheme($themes);

            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('maireHome', array('id' => $project->getId()));
        }

        return $this->render('private/maires/maireFormProjet.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/maire/favoris", name="maireFavoris")
     */
    public function maireFavorisAction()
    {
        return $this->render('private/favoris.html.twig');
    }


    //PARTIE PARTENAIRE

    /**
     * @Route("/partenaire", name="partHome")
     */
    public function partIndexAction()
    {
        return $this->render('private/partenaires/partIndex.html.twig');
    }

    /**
     * @Route("/partenaire/profil", name="partProfil")
     */
    public function partProfilAction(Request $request)
    {

        $partner = new Partner();
        $form = $this->createForm('AppBundle\Form\PartnerType', $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush();

            return $this->redirectToRoute('partHome', array('id' => $partner->getId()));
        }

        return $this->render('private/partenaires/partProfil.html.twig', array(
            'partner' => $partner,
            'form' => $form->createView(),
        ));

    }


    /**
     * @Route("/partenaire/presentation", name="partPres")
     * @Method({"GET", "POST"})
     */
    public function partFormFicheAction(Request $request)
    {

        $company = new Company();
        $form = $this->createForm('AppBundle\Form\CompanyType', $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('admin_company_show', array('id' => $company->getId()));
        }

        return $this->render('private/partenaires/partFormPresentation.html.twig', array(
            'company' => $company,
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/admin", name="adminIndex")
     */
    public function adminIndexAction()
    {
        return $this->render('private/admin/adminIndex.html.twig');
    }

    /**
     * @Route("/admin/contenus", name="adminContenus")
     */
    public function adminContenusAction()
    {
        return $this->render('private/admin/adminContenus.html.twig');
    }


}