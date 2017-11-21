<?php

namespace AMRF\PublicRooterBundle\Controller;

use AMRF\PublicRooterBundle\Entity\Company;
use AMRF\PublicRooterBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PublicRooterController extends Controller
{

    //PARTIE PUBLIC


    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('AMRFPublicRooterBundle:public:index.html.twig');
    }

    /**
     * @Route("/amrf", name="amrf")
     */
    public function amrfAction()
    {
        return $this->render('AMRFPublicRooterBundle:public:amrf.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('AMRFPublicRooterBundle:public:contact.html.twig');
    }

    /**
     * @Route("/confidential", name="confidential")
     */
    public function confidentialAction()
    {
        return $this->render('AMRFPublicRooterBundle:public:confidential.html.twig');
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentionsAction()
    {
        return $this->render('AMRFPublicRooterBundle:public:mentions.html.twig');
    }


    //PARTIE PRIVE

    /**
     * @Route("/search", name="recherche")
     */
    public function searchAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:search.html.twig');
    }

    /**
     * @Route("/projet", name="projet")
     */
    public function projetAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:projet.html.twig');
    }
    /**
     * @Route("/annuaire/", name="annuaire")
     */
    public function partListeAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:annuaire.html.twig');
    }

    /**
     * @Route("/favoris", name="favoris")
     */
    public function partFavorisAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:favoris.html.twig');
    }
    //PARTIE MAIRE

    /**
     * @Route("/maire/profil", name="maireProfil")
     */
    public function maireProfilAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:maires/maireProfil.html.twig');
    }

    /**
     * @Route("/maire", name="maireHome")
     */
    public function maireIndexAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:maires/maireIndex.html.twig');
    }

    /**
     * @Route("/maire/projet", name="maireProjets")
     */
    public function maireProjetAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:maires/maireProjet.html.twig');
    }

    /**
     * @Route("/maire/projet/new", name="maireFormProjet")
     */
    public function mairesFormProjetAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm('AMRF\PublicRooterBundle\Form\ProjectType', $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('maireHome', array('id' => $project->getId()));
        }


        return $this->render('AMRFPublicRooterBundle:private:maires/maireFormProjet.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/maire/favoris", name="maireFavoris")
     */
    public function maireFavorisAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:favoris.html.twig');
    }


    //PARTIE PARTENAIRE

    /**
     * @Route("/partenaire", name="partHome")
     */
    public function partIndexAction()
    {
        return $this->render('AMRFPublicRooterBundle:private/partenaires:partIndex.html.twig');
    }

    /**
     * @Route("/partenaire/profil", name="partProfil")
     */
    public function partProfilAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:partenaires/partProfil.html.twig');
    }



    /**
     * @Route("/partenaire/presentation", name="partPres")
     */
    public function partFormFicheAction(Request $request)
    {
        $company = new Company();
        $form = $this->createForm('AMRF\PublicRooterBundle\Form\CompanyType', $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('partHome', array('id' => $company->getId()));
        }

        return $this->render('AMRFPublicRooterBundle:private:partenaires/partFormPresentation.html.twig', array(
            'company' => $company,
            'form' => $form->createView(),
        ));


    }

    /**
     * @Route("/admin", name="adminIndex")
     */
    public function adminIndexAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:admin/adminIndex.html.twig');
    }

    /**
     * @Route("/admin/contenus", name="adminContenus")
     */
    public function adminContenusAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:admin/adminContenus.html.twig');
    }

}