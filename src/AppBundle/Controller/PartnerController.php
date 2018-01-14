<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Uploader;


use AppBundle\Service\UploadService;
use DateTime;
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
		$user = $this->getUser();
		$user->setLastLogin(new DateTime('now'));
		$em = $this->getDoctrine()->getManager();
		$em->persist($user);
		$em->flush();
		return $this->render('private/partenaires/partIndex.html.twig');
	}

	/**
	 * @Route("profil/", name="partner_profil")
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
	 */
	public function partnerProfilAction(Request $request)
	{
		$user = $this->getUser();
		$partner = $user->getPartner();
		$form = $this->createForm('AppBundle\Form\PartnerType', $partner);
		$form->handleRequest($request);

		$em = $this->getDoctrine()->getManager();

		if ($form->isSubmitted() && $form->isValid()) {
			$em->persist($user);
			$em->flush();
			$this->addFlash(
				'notice',
				'<p>Vos informations ont bien été enregistrées</p>'
			);

			return $this->redirectToRoute('partner_profil', array('id' => $partner->getId()));
		}

		return $this->render('private/partenaires/partProfil.html.twig', array(
			'partner' => $partner,
			'form' => $form->createView(),
		));
	}


	/**
	 * @Route("presentation", name="partner_press")
	 * @Method({"GET", "POST"})
	 * @param Request $request
	 * @param UploadService $uploadService
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
	 */
	public function partnerPressEditAction(Request $request, UploadService $uploadService)
	{

		$uploaderImage = new Uploader();
		$uplodImageForm = $this->createForm('AppBundle\Form\UploaderType', $uploaderImage);
		$uplodImageForm->handleRequest($request);

		$partner = $this->getUser()->getPartner();
		$company = $partner->getCompany();

		$form = $this->createForm('AppBundle\Form\CompanyType', $company);
		$form->remove("logo");
		$form->handleRequest($request);

		if ($uplodImageForm->isSubmitted() && $uplodImageForm->isValid()) {
			$files = $uploaderImage->getPath();

			$newLogo = $uploadService->fileUpload($files, '/company/' . $company->getId() . '/file', "img");
			$company->setLogo($newLogo);

			$this->getDoctrine()->getManager()->flush();
			return $this->redirectToRoute('partner_press');
		}

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($company);
			$em->flush();
			$this->addFlash(
				'notice',
				'<p>Vos informations ont bien été enregistrées</p>'
			);

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
	 * @return Response
	 */
	public function partnerFavoriteAction()
	{
		$favorites = $this->getDoctrine()->getRepository('AppBundle:Favorite')->getFavoriteByUserId($this->getUser()->getId());
		return $this->render('private/favoris.html.twig', [
			'favorites' => $favorites,
		]);
	}

	public function getDefaultOptions(array $options)
	{
		return array(
			'csrf_protection' => false,
			// Rest of options omitted
		);
	}

}