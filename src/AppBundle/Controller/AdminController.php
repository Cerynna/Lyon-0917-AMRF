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

    /**
     * @Route("/admin/userTest", name="admin_User_Test")
     * @return Response
     */
    public function UserAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Mayor');
        $maxMayor = $repository->MaxMayor();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Mayor');
        $maxPart = $repository->MaxPartner();
        return $this->render('private/admin/adminIndextest.html.twig', [
            'maxMayor' => $maxMayor,
            'maxPart' => $maxPart,
        ]);
    }

    /**
     * @Route("/ajax/listMayor", name="admin_list_mayor")
     *
     */
    public function ListMayorAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $offset = intval($request->request->get('offset'));
            $repository = $this->getDoctrine()->getRepository('AppBundle:Mayor');
            $data = $repository->ListMayor($offset);
            return new JsonResponse(array("data" => $data));
        } else {
            throw new HttpException('500', 'Invalid call');
        }
    }
    /**
     * @Route("/ajax/listPart", name="admin_list_partner")
     *
     */
    public function ListPartAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $offset = intval($request->request->get('offset'));
            $repository = $this->getDoctrine()->getRepository('AppBundle:Mayor');
            $data = $repository->ListPartner($offset);
            return new JsonResponse(array("data" => $data));
        } else {
            throw new HttpException('500', 'Invalid call');
        }
    }

}