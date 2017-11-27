<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PublicPage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Publicpage controller.
 *
 * @Route("admin/publicpage")
 */
class AdminPublicPageController extends Controller
{
    /**
     * Lists all publicPage entities.
     *
     * @Route("/", name="admin_publicpage_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publicPages = $em->getRepository('AppBundle:PublicPage')->findAll();

        return $this->render('publicpage/index.html.twig', array(
            'publicPages' => $publicPages,
        ));
    }

    /**
     * Creates a new publicPage entity.
     *
     * @Route("/new", name="admin_publicpage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $publicPage = new Publicpage();
        $form = $this->createForm('AppBundle\Form\PublicPageType', $publicPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publicPage);
            $em->flush();

            return $this->redirectToRoute('admin_publicpage_show', array('id' => $publicPage->getId()));
        }

        return $this->render('publicpage/new.html.twig', array(
            'publicPage' => $publicPage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a publicPage entity.
     *
     * @Route("/{id}", name="admin_publicpage_show")
     * @Method("GET")
     */
    public function showAction(PublicPage $publicPage)
    {
        $deleteForm = $this->createDeleteForm($publicPage);

        return $this->render('publicpage/show.html.twig', array(
            'publicPage' => $publicPage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing publicPage entity.
     *
     * @Route("/{id}/edit", name="admin_publicpage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PublicPage $publicPage)
    {
        $deleteForm = $this->createDeleteForm($publicPage);
        $editForm = $this->createForm('AppBundle\Form\PublicPageType', $publicPage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_publicpage_edit', array('id' => $publicPage->getId()));
        }

        return $this->render('publicpage/edit.html.twig', array(
            'publicPage' => $publicPage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a publicPage entity.
     *
     * @Route("/{id}", name="admin_publicpage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PublicPage $publicPage)
    {
        $form = $this->createDeleteForm($publicPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publicPage);
            $em->flush();
        }

        return $this->redirectToRoute('admin_publicpage_index');
    }

    /**
     * Creates a form to delete a publicPage entity.
     *
     * @param PublicPage $publicPage The publicPage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PublicPage $publicPage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_publicpage_delete', array('id' => $publicPage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
