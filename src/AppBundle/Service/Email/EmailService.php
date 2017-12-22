<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 29/11/17
 * Time: 10:15
 */

namespace AppBundle\Service\Email;


class EmailService
{

    const MAIL_FROM = "wcsprojetmaire@gmail.com";


    const TYPE_MAIL_EVENT = [
        'key' => 1,
        'renderHtml' => 'email/event.html.twig',
        'renderTxt' => 'email/event.txt.twig',
    ];
    const TYPE_MAIL_CONFIRM_PASSWORD = [
        'key' => 2,
        'renderHtml' => 'email/password.html.twig',
        'renderTxt' => 'email/password.txt.twig',
    ];
    const TYPE_MAIL_CONTACT_CONFIRM = [
        'key' => 3,
        'renderHtml' => 'email/contactConfirm.html.twig',
        'renderTxt' => 'email/contactConfirm.txt.twig',
    ];
    const TYPE_MAIL_CONTACT_ADMIN = [
        'key' => 4,
        'renderHtml' => 'email/contactAdmin.html.twig',
        'renderTxt' => 'email/contactAdmin.txt.twig',
    ];
    const TYPE_MAIL_PROJECT_VALID = [
        'key' => 5,
        'renderHtml' => 'email/project.html.twig',
        'renderTxt' => 'email/project.txt.twig',
    ];
    const TYPE_MAIL_NEW_USER = [
        'key' => 6,
        'renderHtml' => 'email/newUser.html.twig',
        'renderTxt' => 'email/newUser.txt.twig',
    ];
    const TYPE_MAIL_PROJECT_MODER = [
        'key' => 7,
        'renderHtml' => 'email/projectModer.html.twig',
        'renderTxt' => 'email/projectModer.txt.twig',
    ];

    protected $mailer;

    protected $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendEmail($mail)
    {
        $message = \Swift_Message::newInstance()
            ->setTo($mail['to'])
            ->setCharset('utf-8')
            ->setFrom(self::MAIL_FROM);


        switch ($mail['type']) {
            case self::TYPE_MAIL_EVENT['key']:
                $message->setSubject($mail['object']);
                $message->setBody(
                    $this->twig->render(self::TYPE_MAIL_EVENT['renderHtml'], [
                            'message' => $mail['message'],
                        ]
                    ), 'text/html');
                $message->addPart(
                    $this->twig->render(self::TYPE_MAIL_EVENT['renderTxt'], [
                        'message' => $mail['message'],
                    ]), 'text/plain');
                break;


            case self::TYPE_MAIL_CONFIRM_PASSWORD['key']:
                $message->setSubject("Confirmation du changement de mot de passe");
                $message->setBody(
                    $this->twig->render(self::TYPE_MAIL_CONFIRM_PASSWORD['renderHtml'], [
                            'message' => $mail['message'],
                        ]
                    ), 'text/html');
                $message->addPart(
                    $this->twig->render(self::TYPE_MAIL_CONFIRM_PASSWORD['renderTxt'], [
                        'message' => $mail['message'],
                    ]), 'text/plain');
                break;


            case self::TYPE_MAIL_CONTACT_ADMIN['key']:
                $message->setSubject("Quelqu'un vous a contacté via le Wiki des Maires");
/*                $message->$mail['from'];*/
                $message->setBody(
                    $this->twig->render(self::TYPE_MAIL_CONTACT_ADMIN['renderHtml'], [
                            'message' => $mail['message'],
                            'name' => $mail['name'],
                            'from' => $mail['from'],
                            'firstName' => $mail['firstName'],
                            'object' => $mail['object'],
                            'statut' => $mail['statut'],
                            'phone' => $mail['phone'],
                            ]
                    ), 'text/html');
                $message->addPart(
                    $this->twig->render(self::TYPE_MAIL_CONTACT_ADMIN['renderTxt'], [
                        'message' => $mail['message'],
                        'name' => $mail['name'],
                        'from' => $mail['from'],
                        'firstName' => $mail['firstName'],
                        'object' => $mail['object'],
                        'statut' => $mail['statut'],
                        'phone' => $mail['phone'],
                    ]), 'text/plain');
                break;


            case self::TYPE_MAIL_CONTACT_CONFIRM['key']:
                $message->setSubject("Prise en compte de votre demande");
                $message->setBody(
                    $this->twig->render(self::TYPE_MAIL_CONTACT_CONFIRM['renderHtml'], [
                            'message' => $mail['message'],
                            'object' => $mail['object'],
                        ]
                    ), 'text/html');
                $message->addPart(
                       $this->twig->render(self::TYPE_MAIL_CONTACT_CONFIRM['renderTxt'], [
                        'message' => $mail['message'],
                        'object' => $mail['object'],
                    ]), 'text/plain');
                break;


            case self::TYPE_MAIL_PROJECT_VALID['key']:
                $message->setSubject("Votre projet est en ligne");
                $message->setBody(
                    $this->twig->render(self::TYPE_MAIL_PROJECT_VALID['renderHtml'], [
                            'message' => $mail['message'],
                        ]
                    ), 'text/html');
                $message->addPart(
                    $this->twig->render(self::TYPE_MAIL_PROJECT_VALID['renderTxt'], [
                        'message' => $mail['message'],
                    ]), 'text/plain');
                break;


            case self::TYPE_MAIL_NEW_USER['key']:
                $message->setSubject("Création de votre compte Wiki des Maires");
                $message->setBody(
                    $this->twig->render(self::TYPE_MAIL_NEW_USER['renderHtml'], [
                            'message' => $mail['message'],
                        ]
                    ), 'text/html');
                $message->addPart(
                    $this->twig->render(self::TYPE_MAIL_NEW_USER['renderTxt'], [
                        'message' => $mail['message'],
                    ]), 'text/plain');
                break;


            case self::TYPE_MAIL_PROJECT_MODER['key']:
                $message->setSubject("Votre projet est envoyé pour modération");
                $message->setBody(
                    $this->twig->render(self::TYPE_MAIL_PROJECT_MODER['renderHtml'], [
                            'message' => $mail['message'],
                        ]
                    ), 'text/html');
                $message->addPart(
                    $this->twig->render(self::TYPE_MAIL_PROJECT_MODER['renderTxt'], [
                        'message' => $mail['message'],
                    ]), 'text/plain');
                break;


            default:
                /** CA BUG */
                break;

        }

        $this->mailer->send($message);

    }
}