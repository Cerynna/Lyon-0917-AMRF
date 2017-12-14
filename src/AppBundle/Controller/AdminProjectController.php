<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\Uploader;
use AppBundle\Service\SlugService;
use AppBundle\Service\UploadService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
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

        $projects = $em->getRepository('AppBundle:Project')->getProjectOrderBY('status');


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
    public function newAction(Request $request, SlugService $slug)
    {
        $project = new Project();
        $form = $this->createForm('AppBundle\Form\ProjectType', $project);
		$form->remove('slug');
        $form->handleRequest($request);

        $uploaderImage = new Uploader();
        $uplodImageForm = $this->createForm('AppBundle\Form\UploaderType', $uploaderImage, [
            'block_name' => 'image',
        ]);
        $uplodImageForm->handleRequest($request);

        $uploaderFile = new Uploader();
        $uplodFileForm = $this->createForm('AppBundle\Form\UploaderType', $uploaderFile);
        $uplodFileForm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
			$project->setSlug($slug->slug($project->getTitle()));
			$project->setCreationDate(new \DateTime('now'));
			$project->setUpdateDate(new \DateTime('now'));
			$project->setProjectDate(new \DateTime('now'));
            $em->persist($project);
            $em->flush();
            return $this->redirectToRoute('admin_project_edit', array(
                'slug' => $project->getSlug(),

            ));
        }

        return $this->render('project/new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
            'upload_image_form' => $uplodImageForm->createView(),
            'upload_file_form' => $uplodFileForm->createView(),
        ));
    }

    /**
     * Finds and displays a project entity.
     *
     * @Route("/{slug}", name="admin_project_show")
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
     * @Route("/edit/{slug}/", name="admin_project_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Project $project, UploadService $uploadService, SlugService $slugService)
    {
        $deleteForm = $this->createDeleteForm($project);

        $editForm = $this->createForm('AppBundle\Form\ProjectType', $project);
		$editForm->remove('slug');
        $editForm->remove('images');
        $editForm->remove('file');
        $editForm->handleRequest($request);

        $uploaderImage = new Uploader();
        $uplodImageForm = $this->createForm('AppBundle\Form\UploaderType', $uploaderImage);
        $uplodImageForm->handleRequest($request);

        $uploaderFile = new Uploader();
        $uplodFileForm = $this->createForm('AppBundle\Form\UploaderType', $uploaderFile);
        $uplodFileForm->handleRequest($request);


        if ($uplodFileForm->isSubmitted() && $uplodFileForm->isValid()) {
            $file = $uploaderFile->getPath();
            $fileNewDB = $uploadService->fileUpload($file, '/project/' . $project->getId() . '/file');
            $project->setFile($fileNewDB);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_project_edit', array(
                'slug' => $project->getSlug(),
            ));
        }

        if ($uplodImageForm->isSubmitted() && $uplodImageForm->isValid()) {
            $files = $uploaderImage->getPath();
            $images = $project->getImages();
            $dbimg = $images;
            $dbimg[] = $uploadService->fileUpload($files, '/project/' . $project->getId() . '/photos');
            $project->setImages($dbimg);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_project_edit', array(
                'slug' => $project->getSlug(),
            ));
        }


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
/*            $themes = $project->getThemes();
            $project->resetThemes();
            foreach ($themes as $theme) {
                $project->addTheme($theme);
            }*/
            $project->setSlug($slugService->slug($project->getTitle()));
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('admin_project_edit', array('slug' => $project->getSlug()));
        }

        return $this->render('project/edit.html.twig', array(
            'project' => $project,
            'edit_form' => $editForm->createView(),
            'upload_image_form' => $uplodImageForm->createView(),
            'upload_file_form' => $uplodFileForm->createView(),
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
            ->getForm();
    }
}
