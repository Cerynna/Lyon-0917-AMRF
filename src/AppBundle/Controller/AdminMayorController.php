<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mayor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Mayor controller.
 *
 * @Route("admin/mayor")
 */
class AdminMayorController extends Controller
{
	/**
	 * Lists all mayor entities.
	 *
	 * @Route("/", name="admin_mayor_index")
	 * @Method("GET")
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$queryBuilder = $em->getRepository('AppBundle:Mayor')->createQueryBuilder('m')->orderBy('m.id', "DESC");
		$query = $queryBuilder->getQuery();

		/**
		 * @var $paginator \Knp\Component\Pager\Paginator
		 */
		$paginator = $this->get('knp_paginator');
		$result = $paginator->paginate(
			$query,
			$request->query->getInt('page', 1),
			$request->query->getInt('limit', 10)
		);

		return $this->render('mayor/index.html.twig', array(
			'mayors' => $result,
		));
	}

	/**
	 * Creates a new mayor entity.
	 *
	 * @Route("/new", name="admin_mayor_new")
	 * @Method({"GET", "POST"})
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function newAction(Request $request)
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

		return $this->render('mayor/new.html.twig', array(
			'mayor' => $mayor,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a mayor entity.
	 *
	 * @Route("/{id}", name="admin_mayor_show")
	 * @Method("GET")
	 * @param Mayor $mayor
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function showAction(Mayor $mayor)
	{
		$deleteForm = $this->createDeleteForm($mayor);

		return $this->render('mayor/show.html.twig', array(
			'mayor' => $mayor,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing mayor entity.
	 *
	 * @Route("/{id}/edit", name="admin_mayor_edit")
	 * @Method({"GET", "POST"})
	 * @param Request $request
	 * @param Mayor $mayor
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function editAction(Request $request, Mayor $mayor)
	{
		$deleteForm = $this->createDeleteForm($mayor);
		$editForm = $this->createForm('AppBundle\Form\MayorType', $mayor);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('admin_mayor_edit', array('id' => $mayor->getId()));
		}

		return $this->render('mayor/edit.html.twig', array(
			'mayor' => $mayor,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a mayor entity.
	 *
	 * @Route("/{id}", name="admin_mayor_delete")
	 * @Method("DELETE")
	 * @param Request $request
	 * @param Mayor $mayor
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, Mayor $mayor)
	{
		$form = $this->createDeleteForm($mayor);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($mayor);
			$em->flush();
		}

		return $this->redirectToRoute('admin_mayor_index');
	}

	/**
	 * Creates a form to delete a mayor entity.
	 *
	 * @param Mayor $mayor The mayor entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Mayor $mayor)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('admin_mayor_delete', array('id' => $mayor->getId())))
			->setMethod('DELETE')
			->getForm();
	}
}
