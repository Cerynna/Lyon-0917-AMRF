<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 04/01/18
 * Time: 15:56
 */

namespace AppBundle\Service\ChangePassword;

use AppBundle\Entity\ChangePassword;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Doctrine\ORM\EntityManager;


class ChangePasswordService
{

    protected $entityManager;
    protected $form_password;
    protected $request;

    public function __construct(EntityManager $entityManager, Form $form_password, Request $request)
    {
        $this->em = $entityManager;
        $this->form_password = $form_password;
        $this->request = $request;
    }

    public function changePassword(Form $form_password, Request $request)
    {
        $changePassword = new ChangePassword();
        $user = $this->getUser();
        $partner = $user->getPartner();
        $form_password = $this->createForm('AppBundle\Form\ChangePasswordType', $changePassword);
        $form_password->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form_password->isSubmitted() && $form_password->isValid()) {
            $encoderService = $this->get('security.password_encoder');
            if ($encoderService->isPasswordValid($user, $changePassword->oldPassword)) {
                $user->setPassword($encoderService->encodePassword($user, $changePassword->newPassword));
                $em->persist($user);
                $em->flush();
            }
            $this->addFlash(
                'notice',
                'Votre nouveau mot de passe a bien été enregistré. Merci de vous reconnecter'
            );
            return $this->redirectToRoute('logout');

        }
    }
}