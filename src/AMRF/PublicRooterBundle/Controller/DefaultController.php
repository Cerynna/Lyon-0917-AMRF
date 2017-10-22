<?php

namespace AMRF\PublicRooterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AMRFPublicRooterBundle:public:index.html.twig');
    }
}
