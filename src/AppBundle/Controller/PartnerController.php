<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ChangePassword;
use AppBundle\Entity\Mayor;
use AppBundle\Entity\Partner;
use AppBundle\Entity\Company;
use AppBundle\Entity\Project;

use AppBundle\Entity\Uploader;
use AppBundle\Entity\User;
use AppBundle\Service\Email\EmailService;
use AppBundle\Service\UploadService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EmailService $emailService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function partnerProfilAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, EmailService $emailService)
    {
        $user = $this->getUser();
        $partner = $user->getPartner();
        $form = $this->createForm('AppBundle\Form\PartnerType', $partner);
        $form->handleRequest($request);

        $changePassword = new ChangePassword();
        $form_password = $this->createForm('AppBundle\Form\ChangePasswordType', $changePassword);
        $form_password->handleRequest($request);
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
        if ($form_password->isSubmitted() && $form_password->isValid()) {
            $encoderService = $this->get('security.password_encoder');
            if ($encoderService->isPasswordValid($user, $changePassword->oldPassword)) {
                $user->setPassword($encoderService->encodePassword($user, $changePassword->newPassword));
                $em->persist($user);
                $em->flush();

                $messageconfirm = [
                    'to' => $user->getEmail(),
                    'type' => EmailService::TYPE_MAIL_CONFIRM_PASSWORD['key'],
                    'login' => $user->getLogin(),
                ];
                $emailService->sendEmail($messageconfirm);

                $this->addFlash(
                    'notice',
                    'Votre nouveau mot de passe a bien été enregistré. Merci de vous reconnecter'
                );
                return $this->redirectToRoute('logout');
            } else {
                $this->addFlash(
                    'notice',
                    'Le mot de passe saisi ne correspond pas. Veuillez saisir à nouveau votre mot de passe'
                );

            }
        }

        return $this->render('private/partenaires/partProfil.html.twig', array(
            'partner' => $partner,
            'form' => $form->createView(),
            'form_password' => $form_password->createView(),
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

            $newLogo = $uploadService->fileUpload($files, '/company/' . $company->getId() . '/file', "img" );
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