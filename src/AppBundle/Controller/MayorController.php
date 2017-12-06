<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 27/11/17
 * Time: 16:09
 */

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Mayor;
use AppBundle\Entity\Partner;
use AppBundle\Entity\Company;
use AppBundle\Entity\Project;

use AppBundle\Entity\TitleProject;
use AppBundle\Service\SlugService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("mayor/")
 */
class MayorController extends Controller
{

    /**
     * @Route("", name="mayor_index")
     */
    public function mayorIndexAction()
    {
        return $this->render('private/maires/maireIndex.html.twig');
    }

    /**
     * @Route("profil", name="mayor_profil")
     */
    public function mayorProfilAction(Request $request)
    {
        $mayor = new Mayor();
        $form = $this->createForm('AppBundle\Form\MayorType', $mayor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mayor);
            $em->flush();

            return $this->redirectToRoute('admin_mayor_show', array('id' => $mayor->getId()));
        }

        return $this->render('private/maires/maireProfil.html.twig', array(
            'mayor' => $mayor,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("project", name="mayor_project")
     */
    public function mayorProjectAction()

    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $mayorid = $user->getMayor()->getid();

        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository("AppBundle:Project")->getProjectByMayor($mayorid);


        return $this->render('private/maires/maireProjet.html.twig', array(
            'projects'=>$projects,
        ));
    }

    /**
     * @Route("project/new", name="mayor_project_new")
     * @Method({"GET", "POST"})
     */
    public function mayorProjectNewAction(Request $request, SlugService $slugService)
    {
        $projectTitle = new TitleProject();
        $form = $this->createForm('AppBundle\Form\TitleProjectType', $projectTitle);
        $form->handleRequest($request);

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $MayorConnect = $user->getMayor();

        if ($form->isSubmitted() && $form->isValid()) {

            $project = new Project();
            $project->setTitle($projectTitle->getTitle());
            $project->setMayor($MayorConnect);
            $project->setCreationDate(new \DateTime('now'));
            $project->setUpdateDate(new \DateTime('now'));
            $project->setProjectDate(new \DateTime('now'));
            $project->setSlug($slugService->slug($projectTitle->getTitle()));


            $em = $this->getDoctrine()->getManager();

            $em->persist($project);
            $em->flush();
            return $this->redirectToRoute('mayor_project_edit', array('id' => $project->getId()));
        }


        return $this->render(':private/maires:projectNew.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("project/edit/{id}", name="mayor_project_edit")
     * @Method({"GET", "POST"})
     */
    public function mayorProjectEditAction(Request $request, Project $project, SlugService $slugService)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $idMayorConnect = $user->getMayor()->getId();
        $idMayorProject = $project->getMayor()->getId();


        if ($idMayorConnect === $idMayorProject) {
            $form = $this->createForm('AppBundle\Form\ProjectType', $project);
            $form->remove('images');
            $form->remove('file');
            $form->remove('creationDate');
            $form->remove('updateDate');
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $project->setSlug($slugService->slug($projectTitle->getTitle()));
                $em->persist($project);
                $em->flush();

                return $this->redirectToRoute('mayor_project_edit', array('id' => $project->getId()));
            }

            return $this->render('private/maires/projectEdit.html.twig', array(
                'project' => $project,
                'form' => $form->createView(),
            ));
        } else {
            return $this->redirectToRoute('mayor_index');
        }

    }

    /**
     * @Route("favorite", name="mayor_favorite")
     */
    public function mayorFavoriteAction()
    {
        return $this->render('private/favoris.html.twig');
    }

}