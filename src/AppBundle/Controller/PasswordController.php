<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 04/01/18
 * Time: 17:41
 */

namespace AppBundle\Controller;

use AppBundle\Entity\ChangePassword;
use AppBundle\Entity\User;
use AppBundle\Service\Email\EmailService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class PasswordController extends Controller
{
    /**
     * @Route("/password")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EmailService $emailService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder, EmailService $emailService)
    {
        $user = $this->getUser();
        $mayor = $user->getMayor();
        $partner = $user->getPartner();
        $changePassword = new ChangePassword();
        $changePassword->setLogin($user->getLogin());
        $form_password = $this->createForm('AppBundle\Form\ChangePasswordType', $changePassword);
        $form_password->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
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
        return $this->render('private/changePassword.html.twig', array(
            'form_password' => $form_password->createView(),
        ));
    }

}