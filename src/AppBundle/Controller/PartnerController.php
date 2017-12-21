<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mayor;
use AppBundle\Entity\Partner;
use AppBundle\Entity\Company;
use AppBundle\Entity\Project;

use AppBundle\Entity\Uploader;
use AppBundle\Entity\User;
use AppBundle\Service\UploadService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("partner/")
 */
class PartnerController extends Controller
{
    /**
     * @Route("", name="partner_index")
     */
    public function partnerIndexAction()
    {
        return $this->render('private/partenaires/partIndex.html.twig');
    }

    /**
     * @Route("profil/", name="partner_profil")
     */
    public function partnerProfilAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
//        $idPart = $user->getPartner()->getId();
        $partner = $user->getPartner();
        /*$em = $this->getDoctrine()->getManager();
        $repoUser = $em->getRepository(User::class);
        $user = $repoUser->getUserPartner($idPart);*/

        $form = $this->createForm('AppBundle\Form\PartnerType', $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush();

            return $this->redirectToRoute('partner_profil');
        }
        return $this->render('private/partenaires/partProfil.html.twig', array(
            'partner' => $partner,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("presentation", name="partner_press")
     * @Method({"GET", "POST"})
     */
    public function partnerPressEditAction(Request $request, UploadService $uploadService)
    {

        $uploaderImage = new Uploader();
        $uplodImageForm = $this->createForm('AppBundle\Form\UploaderType', $uploaderImage);
        $uplodImageForm->handleRequest($request);

        $partner = $this->get('security.token_storage')->getToken()->getUser()->getPartner();
        $company = $partner->getCompany();

        $form = $this->createForm('AppBundle\Form\CompanyType', $company);
        $form->remove("logo");
        $form->handleRequest($request);

        if ($uplodImageForm->isSubmitted() && $uplodImageForm->isValid()) {
            $files = $uploaderImage->getPath();

            $newLogo = $uploadService->fileUpload($files, '/company/' . $company->getId() . '/file', "img" );
            $company->setLogo($newLogo);

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('partner_press');
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('partner_press');
        }
        return $this->render('private/partenaires/partFormPresentation.html.twig', array(
            'company' => $company,
            'form' => $form->createView(),
            'upload_image_form' => $uplodImageForm->createView(),
        ));
    }

    /**
     * @Route("favorite", name="partner_favorite")
     */
    public function partnerFavoriteAction()
    {
        return $this->render('private/favoris.html.twig');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'csrf_protection' => false,
            // Rest of options omitted
        );
    }

}