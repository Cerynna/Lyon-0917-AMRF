<?php

namespace AMRF\PublicRooterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class PublicRooterController extends Controller
{
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
    /**
     * @Route("/search", name="recherche")
     */
    public function searchAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:search.html.twig');
    }
    /**
     * @Route("/maire/profil", name="maireProfil")
     */
    public function maireProfilAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:maires/ProfilMaire.html.twig');
    }
    /**

     * @Route("/projet", name="Projet")
     */
    public function projetAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:projet.html.twig');
    }

     * @Route("/partenaires", name="partenaire")
     */
    public function partIndexAction()
    {
        return $this->render('AMRFPublicRooterBundle:private/partenaires:partIndex.html.twig');
    }


     * @Route("/maire", name="maireHome")
     */
    public function mairesIndexAction()
    {
        return $this->render('AMRFPublicRooterBundle:private:maires/MairesIndex.html.twig');
    }

}