<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mayor;
use AppBundle\Entity\User;
use function is_null;
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
 * Class AdminUserController
 * @package AppBundle\Controller
 */
class AdminUserController extends Controller
{

    /**
     * @Route("/", name="admin_user_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function UserIndexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Mayor');
        $maxMayor = $repository->MaxMayor();
        $maxPart = $repository->MaxPartner();
        $testAjax = $repository->ListMayorFilter("692", "");
        $form = $this->createForm('AppBundle\Form\FiltreUserMayorType');



        return $this->render('user/index.html.twig', [
            'maxMayor' => $maxMayor,
            'maxPart' => $maxPart,
            'testAjax' => $testAjax,
            'filtreMayor' => $form->createView()
        ]);
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="admin_user_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if ($request->request->get("changPass") === null) {
                $user->setStatus(User::USER_STATUS_ACTIF);
            }else {
                $user->setStatus(User::USER_STATUS_INACTIF);
            }
            $user->setCreationDate(new \DateTime('now'));
            $user->setLastLogin(new \DateTime('now'));

            if ($user->getRole() === User::USER_ROLE_MAYOR) {
                $user->setPartner(null);
                if ($user->getPassword() === null) {
                    $user->setPassword($user->getMayor()->getInsee() . $user->getMayor()->getZipCode());
                }
                $password = $passwordEncoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);
                $mayor = $user->getMayor();
                $ResultAPI = $user->ResultApiGouvMayor($mayor->getInsee());
                $mayor->setPopulation($ResultAPI["population"]);
                $mayor->setRegion($ResultAPI["codeRegion"]);
                $mayor->setDepartment($ResultAPI["codeDepartement"]);
                $mayor->setLongitude($ResultAPI["centre"]["coordinates"][0]);
                $mayor->setLatitude($ResultAPI["centre"]["coordinates"][1]);
                $em->persist($user);
                $em->persist($mayor);
            }
            if ($user->getRole() === User::USER_ROLE_PARTNER) {
                $user->setMayor(null);
                $partner = $user->getPartner();
                $company = $partner->getCompany();

                /// A MODIF VOIR AVEC API GOUV DES SIRET/SIREN
                if ($user->getPassword() === null) {
                    $user->setPassword($user->getLogin());
                }
                $password = $passwordEncoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);

                $em->persist($user);
                $em->persist($partner);
                $em->persist($company);
            }
            if ($user->getRole() === User::USER_ROLE_ADMIN) {
                $user->setMayor(null);
                $user->setPartner(null);
            }

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
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

			if ($user->getRole() === User::USER_ROLE_MAYOR) {
				$user->setPartner(null);
			}
			if ($user->getRole() === User::USER_ROLE_PARTNER) {
				$user->setMayor(null);
			}

            if ($user->getRole() === User::USER_ROLE_MAYOR) {
                $user->setPartner(null);
            }
            if ($user->getRole() === User::USER_ROLE_PARTNER) {
                $user->setMayor(null);
            }
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
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if (!is_null($user->getMayor())){
                $mayor = $user->getMayor();
                $em->remove($mayor);
            }
            if (!is_null($user->getPartner())){
                $partner = $user->getPartner();
                $company = $partner->getCompany();
                $em->remove($partner);
                $em->remove($company);
            }
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
     * @param User $user
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


}
