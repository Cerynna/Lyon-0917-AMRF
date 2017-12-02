<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\Uploader;
use AppBundle\Service\UploadService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Project controller.
 *
 * @Route("admin/project")
 */
class AdminProjectController extends Controller
{
    /**
     * Lists all project entities.
     *
     * @Route("/", name="admin_project_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('AppBundle:Project')->findAll();

        return $this->render('project/index.html.twig', array(
            'projects' => $projects,
        ));
    }

    /**
     * Creates a new project entity.
     *
     * @Route("/new", name="admin_project_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm('AppBundle\Form\ProjectType', $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('admin_project_show', array(
                'id' => $project->getId(),
                'test' => $form,

            ));
        }

        return $this->render('project/new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a project entity.
     *
     * @Route("/{id}", name="admin_project_show")
     * @Method("GET")
     */
    public function showAction(Project $project)
    {
        $deleteForm = $this->createDeleteForm($project);

        return $this->render('project/show.html.twig', array(
            'project' => $project,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing project entity.
     *
     * @Route("/{id}/edit", name="admin_project_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Project $project, UploadService $uploadService, Uploader $uploader)
    {
        $deleteForm = $this->createDeleteForm($project);
        $editForm = $this->createForm('AppBundle\Form\ProjectType', $project);
        $editForm->handleRequest($request);

        $uplodForm = $this->createForm('AppBundle\Form\UploaderType', $uploader);
        $uplodForm->handleRequest($request);

        if ($uplodForm->isSubmitted() && $uplodForm->isValid()) {
            $files = $uploader->getPath();
            $images = $project->getImages();
            $dbimg = $images;
            $dbimg[] = $uploadService->fileUpload($files, '/project/' . $project->getId());
            $project->setImages($dbimg);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_project_edit', array(
                'id' => $project->getId(),
            ));
        }


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /*$images = $project->getImages();
            $dbimg = [];
            foreach ($images as $image) {
                $dbimg[] = $uploadService->fileUpload($image, '/project/' . $project->getId());
            }
            $project->setImages($dbimg);*/

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_project_edit', array('id' => $project->getId()));
        }

        return $this->render('project/edit.html.twig', array(
            'project' => $project,
            'edit_form' => $editForm->createView(),
            'upload_form' => $uplodForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a project entity.
     *
     * @Route("/{id}", name="admin_project_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Project $project)
    {
        $form = $this->createDeleteForm($project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('admin_project_index');
    }

    /**
     * Creates a form to delete a project entity.
     *
     * @param Project $project The project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Project $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_project_delete', array('id' => $project->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
