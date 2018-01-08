<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Dictionary;
use AppBundle\Entity\Project;
use AppBundle\Entity\Search;
use AppBundle\Service\EmailService;
use AppBundle\Service\SearchService;


use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use SensioLabs\Security\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Component\Filesystem\Filesystem;


/**
 * Class PublicController
 * @package AppBundle\Controller
 */
class PublicController extends Controller
{

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        /** Change that is a real code for Update LastLogin */
        $user = $this->getUser();
        if (is_object($user)) {
            $lastloginDB = $user->getLastLogin();
            $today = new \DateTime('now');
            $tomorow = $today->modify('+1 day');
            if ($tomorow <= $lastloginDB) {
                $user->setLastLogin($today);
                $em->flush();
            }
        }
        /** ------------------------------------------------ */

        $projects = $em->getRepository('AppBundle:Project')->getLastProject();
        $array = ["main-1", "main-2"];
        $contents = $em->getRepository('AppBundle:PublicPage')->getContentIndex($array);


        return $this->render('public/index.html.twig', array(
            'projects' => $projects,
            'contents' => $contents,
        ));
    }

    /**
     * @Route("/amrf", name="amrf")
     * @return Response
     */
    public function amrfAction()
    {
        $em = $this->getDoctrine()->getManager();
        $array = ["amrf-1", "amrf-2", "amrf-3"];
        $contents = $em->getRepository('AppBundle:PublicPage')->getContentIndex($array);

        return $this->render('public/amrf.html.twig', array(
            'contents' => $contents,
        ));
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param EmailService $emailService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function contactAction(Request $request, EmailService $emailService)
    {
        $contact = new Contact();
        $form = $this->createForm('AppBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $this->captchaverify($request->get('g-recaptcha-response'))) {
            $message = [
                'to' => 'wcsprojetmaire@gmail.com',
                'from' => $contact->getEmail(),
                'type' => EmailService::TYPE_MAIL_CONTACT_ADMIN['key'],
                'name' => $contact->getName(),
                'firstName' => $contact->getFirstName(),
                'statut' => $contact->getStatut(),
                'phone' => $contact->getPhone(),
                'object' => $contact->getSubject(),
                'message' => $contact->getMessage(),
            ];
            $emailService->sendEmail($message);

            $messageconfirm = [
                'to' => $contact->getEmail(),
                'type' => EmailService::TYPE_MAIL_CONTACT_CONFIRM['key'],
                'object' => $contact->getSubject(),
                'message' => $contact->getMessage(),
            ];
            $emailService->sendEmail($messageconfirm);

            $this->addFlash(
                'notice',
                'Votre message a bien été envoyé'
            );

            return $this->redirectToRoute('home');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'notice',
                'Votre message n\'a pas été envoyé, veuillez compléter le formulaire'
            );

        } elseif ($form->isSubmitted() && !$this->captchaverify($request->get('g-recaptcha-response'))) {
            $this->addFlash(
                'notice',
                '<p>Votre message n\'a pas été envoyé,</p><p>veuillez remplir le CAPTCHA</p>'
            );
        }

        return $this->render('public/contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/confidential", name="confidential")
     * @return Response
     */
    public function confidentialAction()
    {
        $em = $this->getDoctrine()->getManager();
        $array = ["cgu"];
        $contents = $em->getRepository('AppBundle:PublicPage')->getContentIndex($array);

        return $this->render('public/confidential.html.twig', array(
            'contents' => $contents,
        ));
    }

    /**
     * @Route("/mentions", name="mentions")
     * @return Response
     */
    public function mentionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $array = ["ml"];
        $contents = $em->getRepository('AppBundle:PublicPage')->getContentIndex($array);

        return $this->render('public/mentions.html.twig', array(
            'contents' => $contents,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
    }

    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authUtils
     * @return Response
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('public/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }


    /**
     * @param $recaptcha
     * @return mixed
     */
    public function captchaverify($recaptcha)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            "secret" => "6LfGgDYUAAAAAJw5_bYZMgSV1S5zhy4SZByMZ9G0", "response" => $recaptcha));
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);

        return $data->success;
    }
}