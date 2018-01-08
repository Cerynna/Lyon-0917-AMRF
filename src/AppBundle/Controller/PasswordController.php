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
     * @Route("", name="change_password")
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
        //$changePassword->setLogin($user->getLogin());


        $form_password = $this->createForm('AppBundle\Form\ChangePasswordType', $changePassword);
        $form_password->handleRequest($request);

        if ($form_password->isSubmitted() && $form_password->isValid()) {

            $passwordService = $changePassService->changePassword($user, $changePassword->oldPassword, $changePassword->newPassword);

                $this->addFlash(
                    'notice',
                    $passwordService['message']
                );
                if($passwordService['redirect'] == true)
                {
                    return $this->redirectToRoute('logout');
                }
            }

        return $this->render('private/changePassword.html.twig', array(
            'form_password' => $form_password->createView(),
        ));
    }

}