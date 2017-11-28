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

    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $projects = $em->getRepository('AppBundle:Project')->getLastProject();

        return $this->render('public/index.html.twig', array(
            'projects' => $projects,
        ));
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
     * @Route("/search", name="search")
     */
    public function searchAction()
    {
        return $this->render('private/search.html.twig');
    }

    /**
     * @Route("/project", name="sheet_project")
     */
    public function projetAction()
    {
        return $this->render('private/projet.html.twig');
    }

    /**
     * @Route("/directory", name="directory")
     */
    public function partListeAction()
    {
        return $this->render('private/annuaire.html.twig');
    }

    //PARTIE ADMIN

    /**
     * @Route("/admin", name="admin_index")
     */
    public function adminIndexAction()
    {
        return $this->render('private/admin/adminIndex.html.twig');
    }


}