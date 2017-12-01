<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Mayor;
use AppBundle\Entity\Partner;
use AppBundle\Entity\Company;
use AppBundle\Entity\Project;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use SensioLabs\Security\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

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
     * @Route("/admin/", name="admin_index")
     */
    public function adminIndexAction()
    {
        return $this->render('private/admin/adminIndex.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('public/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }


    /**
     * @Route("/deletefile/{fileName}", name="deletefile")
     */
    public function deleteFileAction(Request $request, $fileName)
    {

        if ($request->isXmlHttpRequest()) {

            $imageDelete = str_replace("-", "/", $fileName);
            $imgExplode = explode('/', $imageDelete);
            $em = $this->getDoctrine()->getManager();
            $imagesInDB = $em->getRepository('AppBundle:Project')->getImageProject($imgExplode[2]);
            $newImagesDB = [];
            foreach ($imagesInDB[0]['images'] as $imageInDB) {
                if ($imgExplode[3] != $imageInDB) {
                    $newImagesDB[] = $imageInDB;
                }
            }

            $fs = new Filesystem();
            $fs->remove($imageDelete);

            $em = $this->getDoctrine()->getManager();
            $project = $em->getRepository(Project::class)->find($imgExplode[2]);
            $project->setImages($newImagesDB);

            $em->flush();

            return new Response("Image supprimer " . $imageDelete . " - " . count($imageDelete) . " - " . $imgExplode[3]);
        } else {
            throw new HttpException('500', 'Invalid call');
        }

    }
}