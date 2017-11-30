<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 28/11/17
 * Time: 15:20
 */

namespace AppBundle\Service\Email;


class EmailService
{
    const MAIL_FROM = "wcsprojetmaire@gmail.com";


    const TYPE_MAIL_CHANGE_PASSWORD = 2;
    const TYPE_MAIL_CONTACT_CONFIRM = 3;
    const TYPE_MAIL_CONTACT_ADMIN   = 4;
    const TYPE_MAIL_PROJECT_VALID   = 5;
    const TYPE_MAIL_NEW_USER        = 6;

    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendEmail($mail)
    {

        $message = \Swift_Message::newInstance()
            ->setFrom('wcsprojetmaire@gmail.com')
            ->setTo($mail['to'])
            ->setCharset('utf-8');

        switch ($mail['type']) {
            case self::TYPE_MAIL_EVENT['key'];
        }
        $message->setSubject('Confirmation de votre connexion')
            ->setBody(
                $this->twig->render('email/event.html.twig'), 'text/html')
            ->addPart(
                $this->twig->render('email/event.html.twig'), 'text/plain');
        $this->mailer->send($message);
    }
}