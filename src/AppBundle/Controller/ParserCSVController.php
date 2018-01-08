<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Mayor;
use AppBundle\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\ParserCSV;


/**
 * Class ParserCSVController
 * @package AppBundle\Controller
 * @Route ("/admin/parser")
 */
class ParserCSVController extends Controller
{
    /**
     * @Route("/", name="ParserIndex")
     */
    public function indexAction()
    {
        return $this->render('ParserCSV/index.html.twig');
    }

    /**
     * @Route("/parsercsv/{row}/{timer}", name="ParserCSV", defaults={"row": "0", "timer": "0"})
     */
    public function ParseAction($row, $timer)
    {
        $parser = new ParserCSV();
        $action = $parser->parseCSV('realDB.csv', $row, $timer);

        $user = new User();
        $mayor = new Mayor();


        switch ($action) {
            case true:
                if ($parser->getStatus() == true) {
                    $mayor->setInsee($parser->getInsee());
                    $mayor->setEmail($parser->getEmail());
                    $mayor->setPhone($parser->getTel());
                    $mayor->setTown($parser->getCommune());
                    $mayor->setZipCode($parser->getZipCode());
                    $mayor->setDepartment($parser->getDepartment());
                    $mayor->setRegion($parser->getRegion());
                    $mayor->setLatitude($parser->getLattitude());
                    $mayor->setLongitude($parser->getLongitude());
                    $mayor->setPopulation($parser->getPopulation());

                    $encoder = $this->container->get('security.password_encoder');
                    
                    $user->setLogin($parser->getInsee() . $parser->getZipCode());
                    $user->setPassword($encoder->encodePassword($user, $parser->getInsee()));
                    $user->setRole($user::USER_ROLE_MAYOR);
                    $user->setCreationDate(new DateTime('now'));
                    $user->setStatus($user::USER_STATUS_INACTIF);
                    (empty($parser->getEmail()) ? $parser->setEmail($parser->getInsee() . "@exemple.com") : null);
                    $user->setEmail($parser->getEmail());
                    $user->setMayor($mayor->getId());

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($mayor);
                    $em->persist($user);
                    $em->flush();
                }


                return $this->redirectToRoute('ParserCSV', array(
                    'row' => $parser->getRowRequest(),
                    'timer' => $parser->getTimerRequest()
                ));
                break;
            case false:
                return $this->redirectToRoute('ResultParse', array(
                    'timer' => $parser->getTimerRequest()
                ));
                break;
        }
    }

    /**
     * @Route("/resultparse/", name="ResultParse")
     */
    public function resultAction()
    {

        $csv = array_map('str_getcsv', file('ReportNOT.csv'));

        return $this->render('ParserCSV/index.html.twig', [
            'csv' => $csv
        ]);
    }
}