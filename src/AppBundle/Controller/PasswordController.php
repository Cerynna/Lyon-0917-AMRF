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
use AppBundle\Service\ChangePassService;
use AppBundle\Service\EmailService;
use Faker\Provider\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * Class PasswordController
 * @package AppBundle\Controller
 * @Route("/password")
 */
class PasswordController extends Controller
{
    /**
     * @Route("/change", name="change_password")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EmailService $emailService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder, EmailService $emailService, ChangePassService $changePassService)
    {
        $user = $this->getUser();
        $mayor = $user->getMayor();
        $partner = $user->getPartner();

        $changePassword = new ChangePassword();
        $changePassword->setLogin($user->getLogin());

        $form_password = $this->createForm('AppBundle\Form\ChangePasswordType', $changePassword);
        $form_password->remove('email');
        $form_password->handleRequest($request);

        if ($form_password->isSubmitted() && $form_password->isValid()) {
            $passwordService = $changePassService->changePassword($user, $changePassword->oldPassword, $changePassword->newPassword);

            $this->addFlash(
                'notice',
                $passwordService['message']);

            if ($passwordService['redirect'] == true) {
                $this->addFlash(
                    'notice',
                    $passwordService['message']);
                return $this->redirectToRoute('logout');
            }

        }

        return $this->render('private/changePassword.html.twig', array(
            'form_password' => $form_password->createView(),
        ));
    }

    /**
     * @Route("/forgot", name="forgot_password")
     */
    public function forgotPassword(Request $request, ChangePassService $changePassService)
    {
        $changePassword = new ChangePassword();

        $form_password = $this->createForm('AppBundle\Form\ChangePasswordType', $changePassword);
        $form_password->remove('oldPassword');
        $form_password->remove('newPassword');
        $form_password->handleRequest($request);

        if ($form_password->isSubmitted()) {
            $test = $changePassService->forgotPassword($changePassword->getEmail());

            if ($test['redirect'] == true) {
                $this->addFlash(
                    'notice',
                    $test['message']);
                return $this->redirectToRoute('home');
            } else {
                $this->addFlash(
                    'notice',
                    $test['message']);
            }
        }
        return $this->render('private/forgotPassword.html.twig', array(
            'form_password' => $form_password->createView(),
        ));
    }

    /**
     * @Route("/token/{token}", name="token_password")
     * @param $token
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tokenAction($token, Request $request, ChangePassService $changePassService)
    {

        $em = $this->getDoctrine()->getManager();

        $tokenDB = $em->getRepository('AppBundle:ChangePassword')->findByToken($token);
        $user = $em->getRepository('AppBundle:User')->findById($tokenDB[0]->getIdUser());
        $now = new \DateTime('now');
        $interval = ($now->getTimestamp()) - ($tokenDB[0]->getDate()->getTimestamp());
        if ($interval > 900) {
            $tokenDB[0]->setStatus(1);

        }
        switch ($tokenDB[0]->getStatus()) {
            case 0:
                $changePassword = new ChangePassword();


                $form_password = $this->createForm('AppBundle\Form\ChangePasswordType', $changePassword);
                $form_password->remove('oldPassword');
                $form_password->remove('email');
                $form_password->handleRequest($request);

                if ($form_password->isSubmitted()) {
                    $changePassService->changeTokenPassword($user[0], $changePassword->getNewPassword());

                    $tokenDB[0]->setStatus(3);
                    $em->flush();

                    return $this->redirectToRoute('login');
                }

                return $this->render('private/tokenPassword.html.twig', [
                    'form_password' => $form_password->createView(),
                ]);

                break;
            case 1:
                $this->addFlash(
                'notice',
                "Vous avez dépassé le délai de réinitialisation");
                return $this->redirectToRoute('forgot_password');
                break;
            default:
                return $this->render('private/tokenPassword.html.twig');
                break;
        }


    }
}