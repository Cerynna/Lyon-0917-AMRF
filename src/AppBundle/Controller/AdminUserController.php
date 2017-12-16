<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * User controller.
 *
 * @Route("admin/user")
 */
class AdminUserController extends Controller
{

public $sort = [
	'login' => "",
	'role' => ""
];

public function getSort()
{
	return $this->sort;
}
	/**
	 * Lists all user entities.
	 *
	 * @Route("/", name="admin_user_index")
	 * @Method("GET")
	 */
	public function indexAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		/*        $users = $em->getRepository('AppBundle:User')->findAll();*/

		$queryBuilder = $em->getRepository('AppBundle:User')->createQueryBuilder('u');

		if ($request->query->getAlnum('login')){
			$queryBuilder
				->andwhere('u.login LIKE :login')
				->setParameter('login', '%' . $request->query->getAlnum('login') . '%');
		}

		if ($request->query->getAlnum('role')){
			$queryBuilder
				->andwhere('u.role LIKE :role')
				->setParameter('role', "" . $request->query->getAlnum('role') . "");
		}

		if (isset ($_GET['login'])){
			$this->sort['login'] = $_GET['login'];
		}

		if (isset($_GET['role'])){
			$this->sort['role'] = $_GET['role'];
		}

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

		return $this->render('user/index.html.twig', array(
			'users' 	=> $result,
			'login' 	=> $this->sort['login'],
			'role' 		=> $this->sort['role']
		));
	}

	/**
	 * Creates a new user entity.
	 *
	 * @Route("/new", name="admin_user_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
	{
		$user = new User();
		$form = $this->createForm('AppBundle\Form\UserType', $user);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$password = $passwordEncoder->encodePassword($user, $user->getPassword());
			$user->setPassword($password);

			if ($user->getRole() === User::USER_ROLE_MAYOR) {
				$user->setPartner(null);
			}
			if ($user->getRole() === User::USER_ROLE_PARTNER) {
				$user->setMayor(null);
			}
			if ($user->getRole() === User::USER_ROLE_ADMIN) {
				$user->setMayor(null);
				$user->setPartner(null);
			}
			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();

			return $this->redirectToRoute('admin_user_show', array('id' => $user->getId()));
		}
		return $this->render('user/new.html.twig', array(
			'user' => $user,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a user entity.
	 *
	 * @Route("/{id}", name="admin_user_show")
	 * @Method("GET")
	 */
	public function showAction(User $user)
	{
		$deleteForm = $this->createDeleteForm($user);

		return $this->render('user/show.html.twig', array(
			'user' => $user,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing user entity.
	 *
	 * @Route("/{id}/edit", name="admin_user_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder)
	{
		$deleteForm = $this->createDeleteForm($user);
		$editForm = $this->createForm('AppBundle\Form\UserType', $user);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {

			$password = $passwordEncoder->encodePassword($user, $user->getPassword());
			$user->setPassword($password);

			$this->getDoctrine()->getManager()->flush();
			$this->addFlash(
				'notice',
				'Le user n°' . $user->getLogin() . ' a été modifié.'
			);
			return $this->redirectToRoute('admin_user_edit', array('id' => $user->getId()));
		}

		return $this->render('user/edit.html.twig', array(
			'user' => $user,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a user entity.
	 *
	 * @Route("/{id}", name="admin_user_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, User $user)
	{
		$form = $this->createDeleteForm($user);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($user);
			$em->flush();
		}

		return $this->redirectToRoute('admin_user_index');
	}

	/**
	 * Creates a form to delete a user entity.
	 *
	 * @param User $user The user entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(User $user)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('admin_user_delete', array('id' => $user->getId())))
			->setMethod('DELETE')
			->getForm();
	}
}
