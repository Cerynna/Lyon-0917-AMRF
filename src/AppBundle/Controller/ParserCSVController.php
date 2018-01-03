<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;



class ParserCSV extends Controller
{

    /**
     * @Route("/parsercsv", name="ParserCSV")
     */
    public function indexAction()
    {
        $test = new ParserCSV('','','');
        return $this->render('ParserCSV/index.html.twig');
    }
}