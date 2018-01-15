<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\Uploader;
use AppBundle\Service\EmailService;
use AppBundle\Service\SlugService;
use AppBundle\Service\UploadService;
use AppBundle\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Project controller.
 * Class AdminProjectController
 * @Route("admin/project")
 * @package AppBundle\Controller
 */
class AdminProjectController extends Controller
{
	public $sort = [
		'title' 		=> "",
		'status' 		=> "",
		'value' 		=> "",
		'themes'		=> ""
	];
	public function getSort()
	{
		return $this->sort;
	}
	/**
	 * Lists all project entities.
	 *
	 * @Route("/", name="admin_project_index")
	 * @Method("GET")
	 * @param Request $request
	 * @return Response
	 */
	public function indexAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$thematique = $em->getRepository('AppBundle:Dictionary')->getTheme();
		$maxProject = $em->getRepository('AppBundle:Project')->MaxProject();


		return $this->render('project/index.html.twig', [
			'themes' => $thematique,
			'maxProject' => $maxProject
		]);
	}

	/**
	 * Creates a new project entity.
	 *
	 * @Route("/new", name="admin_project_new")
	 * @Method({"GET", "POST"})
	 * @param Request $request
	 * @param SlugService $slug
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
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
			$project->setStatus(Project::STATUS_DRAFT);
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
	 * @param Project $project
	 * @return Response
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
	 * @param Request $request
	 * @param Project $project
	 * @param UploadService $uploadService
	 * @param SlugService $slugService
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
	 */
	public function editAction(Request $request, Project $project, UploadService $uploadService, SlugService $slugService, EmailService $emailService)
	{
        $user = $this->getUser();
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
			$fileNewDB = $uploadService->fileUpload($file, '/project/' . $project->getId() . '/file', "file");
			$project->setFile($fileNewDB);
			$this->getDoctrine()->getManager()->flush();
			return $this->redirectToRoute('admin_project_edit', array(
				'slug' => $project->getSlug(),
			));
		}
		if ($uplodImageForm->isSubmitted() && $uplodImageForm->isValid()) {
			$files = $uploaderImage->getPath();
			$images = $project->getImages();
			$images[] = $uploadService->fileUpload($files, '/project/' . $project->getId() . '/photos', "img");
			$project->setImages($images);
			$this->getDoctrine()->getManager()->flush();
			/*return $this->redirectToRoute('admin_project_edit', array(
				'slug' => $project->getSlug(),
			));*/
		}
		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$project->setSlug($slugService->slug($project->getTitle()));
			$em->persist($project);
			$em->flush();
            if ($project->setStatus(Project::STATUS_PUBLISH)) {
                $message = [
                    'to' => $user->getEmail(),
                    'type' => EmailService::TYPE_MAIL_PROJECT_VALID['key'],
                    'login' => $user->getLogin(),

                ];
                $emailService->sendEmail($message);
            }
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
	 * @param Request $request
	 * @param Project $project
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
	 * @param Project $project
	 * @return \Symfony\Component\Form\FormInterface
	 */
	private function createDeleteForm(Project $project)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('admin_project_delete', array('id' => $project->getId())))
			->setMethod('DELETE')
			->getForm();
	}
}
