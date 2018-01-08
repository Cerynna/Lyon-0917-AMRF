<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use AppBundle\Entity\Uploader;
use AppBundle\Service\SlugService;
use AppBundle\Service\UploadService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Company controller.
 *
 * @Route("admin/company")
 */
class AdminCompanyController extends Controller
{
    /**
     * Lists all company entities.
     *
     * @Route("/", name="admin_company_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /*        $companies = $em->getRepository('AppBundle:Company')->findAll();*/

        $queryBuilder = $em->getRepository('AppBundle:Company')->createQueryBuilder('m');

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

        return $this->render('company/index.html.twig', array(
            'companies' => $result,
        ));
    }

    /**
     * Creates a new company entity.
     *
     * @Route("/new", name="admin_company_new")
     * @Method({"GET", "POST"})
     */

    public function newAction(Request $request, UploadService $upload, SlugService $slug)

    {
        $company = new Company();
        $form = $this->createForm('AppBundle\Form\CompanyType', $company);
        $form->remove('slug');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $company->setSlug($slug->slug($company->getName()));
            $logo = $company->getLogo();
            if (!empty($logo)) {
                $company->setLogo($upload->fileUpload($logo, "/company/" . $company->getName(), "img"));
            }
            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('admin_company_show', array('slug' => $company->getSlug()));
        }

        return $this->render('company/new.html.twig', array(
            'company' => $company,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a company entity.
     *
     * @Route("/{slug}", name="admin_company_show")
     * @Method("GET")
     */
    public function showAction(Company $company)
    {
        $deleteForm = $this->createDeleteForm($company);

        return $this->render('company/show.html.twig', array(
            'company' => $company,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a company entity.
     *
     * @param Company $company The company entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Company $company)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_company_delete', array('id' => $company->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Displays a form to edit an existing company entity.
     *
     * @Route("/edit/{slug}", name="admin_company_edit")
     * @Method({"GET", "POST"})
     */

    public function editAction(Request $request, Company $company, UploadService $upload, SlugService $slugs)

    {
        $deleteForm = $this->createDeleteForm($company);
        $editForm = $this->createForm('AppBundle\Form\CompanyType', $company);
        $editForm->remove('slug');
        $editForm->remove('logo');
        $editForm->handleRequest($request);

        $uploaderImage = new Uploader();
        $uplodImageForm = $this->createForm('AppBundle\Form\UploaderType', $uploaderImage);
        $uplodImageForm->handleRequest($request);

        dump($company);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            dump($company);

            $company->setSlug($slugs->slug($company->getName()));


            $em->persist($company);
            $em->flush();
            //return $this->redirectToRoute('admin_company_edit', array('slug' => $company->getSlug()));
        }
        if ($uplodImageForm->isSubmitted() && $uplodImageForm->isValid()) {
            $files = $uploaderImage->getPath();
            $newLogo = $upload->fileUpload($files, '/company/' . $company->getId() . '/file', "img");
            $company->setLogo($newLogo);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_company_edit', array('slug' => $company->getSlug()));
        }

        return $this->render('company/edit.html.twig', array(
            'company' => $company,
            'edit_form' => $editForm->createView(),
            'upload_image_form' => $uplodImageForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a company entity.
     *
     * @Route("/{id}", name="admin_company_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Company $company)
    {
        $form = $this->createDeleteForm($company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($company);
            $em->flush();
        }

        return $this->redirectToRoute('admin_company_index');
    }
}
