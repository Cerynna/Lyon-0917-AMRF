<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 29/11/17
 * Time: 10:22
 */

namespace AppBundle\Controller;


use AppBundle\Service\EmailService;
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
            'message' => 'test mail event',
        ];
        $message[] = [
            'to' => 'cerynna@gmail.com',
            'type' => EmailService::TYPE_MAIL_CONFIRM_PASSWORD['key'],
            'message' => 'Test confirm password',
        ];
        $message[] = [
            'to' => 'cerynna@gmail.com',
            'type' => EmailService::TYPE_MAIL_CONTACT_CONFIRM['key'],
            'message' => 'Test contact confirm',

        ];
        $message[] = [
            'to' => 'cerynna@gmail.com',
            'type' => EmailService::TYPE_MAIL_CONTACT_ADMIN['key'],
            'message' => 'test formulaire',
        ];
        $message[] = [
            'to' => 'cerynna@gmail.com',
            'type' => EmailService::TYPE_MAIL_PROJECT_VALID['key'],
            'message' => 'Test projet publié',
        ];
        $message[] = [
            'to' => 'cerynna@gmail.com',
            'type' => EmailService::TYPE_MAIL_NEW_USER['key'],
            'message' => 'test new user',
        ];
        $message[] = [
            'to' => 'cerynna@gmail.com',
            'type' => EmailService::TYPE_MAIL_PROJECT_MODER['key'],
            'message' => 'Test modération',
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
            'message' => 'Tootsie roll pie topping powder sugar plum souffl&eacute;. Gingerbread sugar plum tiramisu powder macaroon candy canes drag&eacute;e icing. Sweet macaroon tootsie roll chocolate chocolate cake. Tootsie roll muffin donut apple pie gummies powder. Lollipop candy canes bonbon sesame snaps danish brownie croissant tiramisu. Oat cake pastry pudding ice cream fruitcake. Muffin pudding croissant pudding tart oat cake caramels sugar plum icing.',
        ];

        return $this->render('email/event.html.twig', array(
                'message' => $message['message']
            )
        );
    }

}