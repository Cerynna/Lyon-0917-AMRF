<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 04/01/18
 * Time: 17:41
 */

namespace AppBundle\Controller;

use AppBundle\Entity\ChangePassword;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


class PasswordController extends Controller
{
    /**
     * @Route("/password")
     */
    public function indexAction()
    {
        return $this->render('private/changePassword.html.twig');
    }
}