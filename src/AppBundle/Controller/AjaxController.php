<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 08/01/18
 * Time: 16:01
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use AppBundle\Entity\Project;
use AppBundle\Entity\Favorite;

use SensioLabs\Security\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Class AjaxController
 * @package AppBundle\Controller
 */
class AjaxController extends Controller
{
    /**
     * @Route("/addFavorite/{type}/{idType}", name="addFavorite")
     * @param Request $request
     * @param $type
     * @param $idType
     * @return Response
     */
    public function addFavorite(Request $request, $type, $idType)
    {
        $idUser = $this->get('security.token_storage')->getToken()->getUser();
        $favorite = new Favorite();
        $favorite->setUser($idUser);
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            if ($type == "project") {
                $project = $this->getDoctrine()->getRepository("AppBundle:Project")->projectById($idType);
                $favorite->setProject($project[0]);
                $favorite->setCompany(null);
            }
            if ($type == "company") {
                $company = $this->getDoctrine()->getRepository("AppBundle:Company")->companyById($idType);
                $favorite->setCompany($company[0]);
                $favorite->setProject(null);
            }
            $em->persist($favorite);
            $em->flush();
            return new Response("Favori ajouté ");

        } else {
            throw new HttpException(500, 'Invalid call');
        }
    }

    /**
     * @Route("/delFavorite/{type}/{idType}", name="delFavorite")
     * @param Request $request
     * @param $type
     * @param $idType
     * @return Response
     */
    public function delFavorite(Request $request, $type, $idType)
    {
        $idUser = $this->getUser();
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $favoris = $em->getRepository("AppBundle:Favorite")->getFavorite($type, $idType, $idUser->getId());
            $em->remove($favoris[0]);
            $em->flush();

            return new Response("Favori supprimé");
        } else {
            throw new HttpException(500, 'Invalid call');
        }
    }

    /**
     * @Route("/deletefile/{fileName}", name="deletefile")
     * @param Request $request
     * @param $fileName
     * @return Response
     */
    public function deleteFileAction(Request $request, $fileName)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $imageDelete = str_replace("-", "/", $fileName);
            $imgExplode = explode('/', $imageDelete);
            $project = $em->getRepository(Project::class)->find($imgExplode[2]);
            if ($imgExplode[1] == "project") {
                if ($imgExplode[3] == 'photos') {
                    $imagesInDB = $em->getRepository('AppBundle:Project')->getImageProject($imgExplode[2]);
                    $newImagesDB = [];
                    foreach ($imagesInDB[0]['images'] as $imageInDB) {
                        if ($imgExplode[4] != $imageInDB) {
                            $newImagesDB[] = $imageInDB;
                        }
                    }
                    $project->setImages($newImagesDB);
                } elseif ($imgExplode[3] == 'file') {
                    $project = $em->getRepository(Project::class)->find($imgExplode[2]);
                    $project->setFile('');
                }
                $em->flush();
                $fs = new Filesystem();
                $fs->remove($imageDelete);
            }
            if ($imgExplode[1] == "company") {
                $company = $em->getRepository(Company::class)->find($imgExplode[2]);
                $company->setLogo('');
            }
            $em->flush();
            $fs = new Filesystem();
            $fs->remove($imageDelete);
            return new Response("Image supprimer " . $imageDelete . " - " . count($imageDelete) . " - " . $imgExplode[4]);
        } else {
            throw new HttpException('500', 'Invalid call');
        }
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

    /**
     * @Route("/ajax/listMayorFiltre", name="list_mayor_filtre")
     *
     */
    public function ListMayorFilterAction(Request $request)
    {
       if ($request->isXmlHttpRequest()) {

            $zipCode = intval($request->request->get('CodePostal'));
            $insee = intval($request->request->get('CodeInsee'));

            $repository = $this->getDoctrine()->getRepository('AppBundle:Mayor');
            $data = $repository->ListMayorFilter($zipCode, $insee);

       /* return new Response(
            '<html><body>Hello</body></html>'
        );*/

           return new JsonResponse(array("data" => $data));
        } else {
            throw new HttpException('500', 'Invalid call');
        }
    }

}