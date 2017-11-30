<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 29/11/17
 * Time: 10:23
 */

namespace AppBundle\Controller;
use AppBundle\Service\Email\EmailService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;



/**
 * Class AdminEmailController
 * @Route("admin/email")
 *
 */
class AdminEmailController extends Controller
{
    /**
     * @Route("/test", name="admin_email_test")
     */
    public function mailTestAction(EmailService $emailService)
    {
        $message = [
            'to'     => 'severinelab@gmail.com',
            'type'   => EmailService::TYPE_MAIL_EVENT['key'],
            'message'=> 'c\'est la fête',
        ];

        $emailService->sendEmail($message);
        $this->addFlash(
            'notice',
            'Email envoyé'
        );
        return new Response(
            '<html><body>Et voilou</body></html>'
        );
    }
}