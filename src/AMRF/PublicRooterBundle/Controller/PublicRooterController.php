<?php

namespace AMRF\PublicRooterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicRooterController extends Controller
{
    /**
     * @Route("/amrf", name="apropos")
     */
    public function amrfAction()
    {
        return $this->render('AMRFPublicRooterBundle:Default:index.html.twig');
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('AMRFPublicRooterBundle:Default:index.html.twig');
    }
    /**
     * @Route("/confidential", name="confidential")
     */
    public function confidentialAction()
    {
        return $this->render('AMRFPublicRooterBundle:Default:index.html.twig');
    }
    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentionsAction()
    {
        return $this->render('AMRFPublicRooterBundle:Default:index.html.twig');
    }
}