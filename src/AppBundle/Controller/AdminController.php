<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 08/01/18
 * Time: 15:58
 */

namespace AppBundle\Controller;


use SensioLabs\Security\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


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