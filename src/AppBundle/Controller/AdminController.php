<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 08/01/18
 * Time: 15:58
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Dictionary;
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

class AdminController extends Controller
{
    /**
     * @Route("/admin/", name="admin_index")
     * @return Response
     */
    public function adminIndexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reposCompany = $em->getRepository("AppBundle:Project");
        $stats = $reposCompany->statProject();


        return $this->render('private/admin/adminIndex.html.twig', [
            'stats' => $stats,
        ]);
    }
}