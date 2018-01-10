<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 08/01/18
 * Time: 13:22
 */

namespace AppBundle\Service;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use const U_STANDARD_ERROR_LIMIT;

class ChangePassService
{
    protected $passwordEncoder;
    protected $emailService;
    protected $em;


    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EmailService $emailService, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
        $this->emailService = $emailService;

    }

    public function changePassword(User $user, $oldPassword, $newPassword)
    {
        if ($this->passwordEncoder->isPasswordValid($user, $oldPassword)) {
            $user->setPassword($this->passwordEncoder->encodePassword($user, $newPassword));
            $user->setStatus(User::USER_STATUS_ACTIF);
            $this->em->flush();
            $messageconfirm = [
                'to' => $user->getEmail(),
                'type' => EmailService::TYPE_MAIL_CONFIRM_PASSWORD['key'],
                'login' => $user->getLogin(),
            ];
            $this->emailService->sendEmail($messageconfirm);

            $result['message'] = "Votre nouveau mot de passe a bien été enregistré. Merci de vous reconnecter";
            $result['redirect'] = true;


        }
        else {
            $result['message'] = "Le mot de passe saisi ne correspond pas. Veuillez saisir à nouveau votre mot de passe";
            $result['redirect'] = false;
        }
        return $result;

    }
}