<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 29/11/17
 * Time: 10:22
 */

namespace AppBundle\Controller;


use AppBundle\Service\Email\EmailService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;


/**
 * Email controller.
 *
 * @Route("admin/email")
 */
class AdminEmailController extends Controller
{
    /**
     * @Route("/test", name="admin_email_test")
     */
    public function mailTestAction(EmailService $emailService)
    {
        $message[] = [
            'to' => 'cerynna@gmail.com',
            'type' => EmailService::TYPE_MAIL_EVENT['key'],
            'object' => 'Message d\'event',
            'message' => 'Salut les moches',
        ];
        $message[] = [
            'to' => 'cerynna@gmail.com',
            'type' => EmailService::TYPE_MAIL_CONFIRM_PASSWORD['key'],
        ];
        $message[] = [
            'to' => 'cerynna@gmail.com',
            'type' => EmailService::TYPE_MAIL_CONTACT_CONFIRM['key'],

        ];
        $message[] = [
            'to' => 'cerynna@gmail.com',
            'type' => EmailService::TYPE_MAIL_CONTACT_ADMIN['key'],
        ];
        $message[] = [
            'to' => 'cerynna@gmail.com',
            'type' => EmailService::TYPE_MAIL_PROJECT_VALID['key'],
        ];
        $message[] = [
            'to' => 'cerynna@gmail.com',
            'type' => EmailService::TYPE_MAIL_NEW_USER['key'],
        ];

        foreach ($message as $mess) {
            $emailService->sendEmail($mess);
        }


        $this->addFlash(
            'notice',
            'Email envoyé.'
        );
        return new Response(
            '<html><body>Et la on envoie un mail</body></html>'
        );
    }

    /**
     * @Route("/preview", name="admin_mail_preview")
     */
    public function previewMail()
    {
        $message = [
            'message' => 'Salut les moches',
        ];

        return $this->render('email/event.html.twig', array(
                'message' => $message['message']
            )
        );
    }

}