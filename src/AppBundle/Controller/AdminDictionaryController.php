<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dictionary;
use Doctrine\Common\Annotations\Reader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Dictionary controller.
 *
 * @Route("admin/dictionary")
 */
class AdminDictionaryController extends Controller
{
	/**
	 * Lists all dictionary entities.
	 *
	 * @Route("/", name="admin_dictionary_index")
	 * @Method("GET")
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$queryBuilder = $em->getRepository('AppBundle:Dictionary')->createQueryBuilder('d');
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

		return $this->render('dictionary/index.html.twig', array(
			'dictionaries' => $result,
		));
	}

	/**
	 * Creates a new dictionary entity.
	 *
	 * @Route("/new", name="admin_dictionary_new")
	 * @Method({"GET", "POST"})
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function newAction(Request $request)
	{
		$dictionary = new Dictionary();
		$form = $this->createForm('AppBundle\Form\DictionaryType', $dictionary);
		$form->remove("value");
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
		    $dictionary->setValue($dictionary->getName());
			$em = $this->getDoctrine()->getManager();
			$em->persist($dictionary);
			$em->flush();

			return $this->redirectToRoute('admin_dictionary_show', array('id' => $dictionary->getId()));
		}

		return $this->render('dictionary/new.html.twig', array(
			'dictionary' => $dictionary,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a dictionary entity.
	 *
	 * @Route("/{id}", name="admin_dictionary_show")
	 * @Method("GET")
	 * @param Dictionary $dictionary
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function showAction(Dictionary $dictionary)
	{
		$deleteForm = $this->createDeleteForm($dictionary);

		return $this->render('dictionary/show.html.twig', array(
			'dictionary' => $dictionary,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing dictionary entity.
	 *
	 * @Route("/{id}/edit", name="admin_dictionary_edit")
	 * @Method({"GET", "POST"})
	 * @param Request $request
	 * @param Dictionary $dictionary
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function editAction(Request $request, Dictionary $dictionary)
	{
		$deleteForm = $this->createDeleteForm($dictionary);
		$editForm = $this->createForm('AppBundle\Form\DictionaryType', $dictionary);
		$editForm->remove("value");
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
		    $dictionary->setValue($dictionary->getName());
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('admin_dictionary_edit', array('id' => $dictionary->getId()));
		}

		return $this->render('dictionary/edit.html.twig', array(
			'dictionary' => $dictionary,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a dictionary entity.
	 *
	 * @Route("/{id}", name="admin_dictionary_delete")
	 * @Method("DELETE")
	 * @param Request $request
	 * @param Dictionary $dictionary
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, Dictionary $dictionary)
	{
		$form = $this->createDeleteForm($dictionary);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($dictionary);
			$em->flush();
		}

		return $this->redirectToRoute('admin_dictionary_index');
	}

	/**
	 * Creates a form to delete a dictionary entity.
	 *
	 * @param Dictionary $dictionary The dictionary entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Dictionary $dictionary)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('admin_dictionary_delete', array('id' => $dictionary->getId())))
			->setMethod('DELETE')
			->getForm();
	}
}
