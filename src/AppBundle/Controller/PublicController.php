<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Company;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Dictionary;
use AppBundle\Entity\Favorite;
use AppBundle\Entity\Partner;
use AppBundle\Entity\Project;
use AppBundle\Entity\Search;
use AppBundle\Entity\User;
use AppBundle\Service\EmailService;
use AppBundle\Service\SearchService;


use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use SensioLabs\Security\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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
                'name'  =>$contact->getName(),
                'firstName'=>$contact->getFirstName(),
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
            "secret" => "6Lf0NkEUAAAAALaHwPK0ANM4Wqw9R6VYoJehRSSL", "response" => $recaptcha));
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);

        return $data->success;
    }

    /**
     * @Route("/CGU", name="GCU")
     * @return Response
     */
    public function confidentialAction()
    {
        $em = $this->getDoctrine()->getManager();
        $array = ["cgu"];
        $contents = $em->getRepository('AppBundle:PublicPage')->getContentIndex($array);

        return $this->render('public/CGU.html.twig', array(
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
        if (!empty($error)) {
            $this->addFlash(
                'notice',
                'Votre login ou votre mot de passe est invalide'
            );
        }
        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('public/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }

    /**
     * @Route("/parser", name="parser_partner")
     */
    public function parserPartnerAction(UserPasswordEncoderInterface $passwordEncoder)
    {
        $csv = array_map('str_getcsv', file('partner.csv'));
        $em = $this->getDoctrine()->getManager();

        unset($csv[0]);
        foreach ($csv as $userCsv) {

            if (!empty ($userCsv[4])) {
                $user = new User;
                $partner = new Partner;
                $company = new Company;

                $userCsv[4] = str_replace(' ', '', $userCsv[4]);
                $userSiren = substr($userCsv[4], 0, 9);

                $user->setLogin($userSiren);
                $user->setCreationDate(new \DateTime('now'));
                $user->setLastLogin(new \DateTime('now'));
                $password = $passwordEncoder->encodePassword($user, $userCsv[4]);
                $user->setPassword($password);
                $user->setStatus(User::USER_STATUS_INACTIF);
                $user->setRole(User::USER_ROLE_PARTNER);
                $user->setEmail($userCsv[3]);
                $partner->setFirstName($userCsv[2]);
                $partner->setLastName($userCsv[1]);
                if (!empty($userCsv[6])) {
                    $partner->setOccupation($userCsv[6]);
                }
                if (!empty($userCsv[5])) {
                    $partner->setPhone(str_replace(' ', '', $userCsv[5]));
                }

                $partner->setEmail($userCsv[3]);
                $company->setName($userCsv[0]);

                $partner->setCompany($company);
                $user->setPartner($partner);

                $em->persist($user);
                $em->persist($partner);
                $em->persist($company);
                $em->flush();
            } else {
                $fp = fopen('errorPartner.csv', 'a');
                fputcsv($fp, $userCsv);
                fclose($fp);
            }
        }

        return new Response('<html><body>hello</body></html>');
    }
}