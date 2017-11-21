<?php

namespace AMRF\PublicRooterBundle\Controller;

use AMRF\PublicRooterBundle\Entity\Mayor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Mayor controller.
 *
 * @Route("admin/mayor")
 */
class MayorController extends Controller
{
    /**
     * Lists all mayor entities.
     *
     * @Route("/", name="admin_mayor_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $mayors = $em->getRepository('AMRFPublicRooterBundle:Mayor')->findAll();

        return $this->render('mayor/index.html.twig', array(
            'mayors' => $mayors,
        ));
    }

    /**
     * Creates a new mayor entity.
     *
     * @Route("/new", name="admin_mayor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $mayor = new Mayor();
        $form = $this->createForm('AMRF\PublicRooterBundle\Form\MayorType', $mayor);
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
     */
    public function editAction(Request $request, Mayor $mayor)
    {
        $deleteForm = $this->createDeleteForm($mayor);
        $editForm = $this->createForm('AMRF\PublicRooterBundle\Form\MayorType', $mayor);
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
            ->getForm()
        ;
    }
}
