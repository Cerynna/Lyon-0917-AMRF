<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 20/12/17
 * Time: 15:44
 */

namespace AppBundle\Controller;


use AppBundle\Entity\ChangePassword;
use AppBundle\Form\ChangePasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class PasswordController extends Controller
{
    public function changePasswordAction(Request $request)
    {
        $changePassword = new ChangePassword();
        $form = $this->createForm('AppBundle\Form\ChangePasswordType', $changePassword);
        $form->handleRequest($request);

        $user = $this->get('security.token_storage')->getToken()->getUser();
    }
}