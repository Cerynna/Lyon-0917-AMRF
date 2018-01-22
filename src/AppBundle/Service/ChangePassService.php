<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 08/01/18
 * Time: 13:22
 */

namespace AppBundle\Service;


use AppBundle\Entity\ChangePassword;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ChangePassService
{
	protected $passwordEncoder;
	protected $emailService;
	protected $em;

	const STATUS_ACTIF = 0;
	const STATUS_INACTIF = 1;
	const STATUS_USED = 2;

	public function __construct(UserPasswordEncoderInterface $passwordEncoder, EmailService $emailService, EntityManagerInterface $em)
	{
		$this->em = $em;
		$this->passwordEncoder = $passwordEncoder;
		$this->emailService = $emailService;

	}

	public function changePassword(User $user, $oldPassword, $newPassword)
	{
		if ($this->passwordEncoder->isPasswordValid($user, $oldPassword)) {
			$result = $this->changeTokenPassword($user, $newPassword);
		} else {
			$result['message'] = "Le mot de passe saisi ne correspond pas. Veuillez saisir à nouveau votre mot de passe";
			$result['redirect'] = false;
		}
		return $result;

	}

	public function changeTokenPassword(User $user, $newPassword)
	{
		$user->setPassword($this->passwordEncoder->encodePassword($user, $newPassword));
		$user->setStatus(User::USER_STATUS_ACTIF);
		$this->em->persist($user);
		$this->em->flush();
		$firstName = "";
		$lastName = "";
		if ($user->getRole() === User::USER_ROLE_MAYOR) {
			$firstName = $user->getMayor()->getFirstName();
			$lastName = $user->getMayor()->getLastName();
		}
		if ($user->getRole() === User::USER_ROLE_PARTNER) {
			$firstName = $user->getPartner()->getFirstName();
			$lastName = $user->getPartner()->getLastName();
		}
		$messageconfirm = [
			'to' => $user->getEmail(),
			'type' => EmailService::TYPE_MAIL_CONFIRM_PASSWORD['key'],
			'login' => $user->getLogin(),
			'firstName' => $firstName,
			'lastName' => $lastName,

		];

		$this->emailService->sendEmail($messageconfirm);

		$result['message'] = "Votre nouveau mot de passe a bien été enregistré. Merci de vous reconnecter";
		$result['redirect'] = true;

		return $result;
	}

	public function forgotPassword($email)
	{

		$result = [];
		$user = $this->em->getRepository("AppBundle:User")->findByEmail($email);
		if ($user != null) {
			$forgot = new ChangePassword();
			$forgot->setIdUser($user[0]->getId());
			$forgot->setDate(new \DateTime('now'));
			$forgot->setStatus(self::STATUS_ACTIF);
			$this->em->persist($forgot);
			$this->em->flush();
			$firstName = "";
			$lastName = "";
			if ($user[0]->getRole() === User::USER_ROLE_MAYOR) {
				$firstName = $user[0]->getMayor()->getFirstName();
				$lastName = $user[0]->getMayor()->getLastName();
			}
			if ($user[0]->getRole() === User::USER_ROLE_PARTNER) {
				$firstName = $user[0]->getPartner()->getFirstName();
				$lastName = $user[0]->getPartner()->getLastName();
			}
			$message = [
				'to' => $user[0]->getEmail(),
				'firstName' => $firstName,
				'lastName' => $lastName,
				'type' => EmailService::TYPE_MAIL_FORGOT_PASSWORD['key'],
				'token' => $forgot->getToken(),
			];
			$this->emailService->sendEmail($message);
			$result['message'] = "Un email de réinitialisation vous a été envoyé";
			$result['redirect'] = true;
		} else {
			$result['message'] = "Cet email n'existe pas dans la liste des utilisateurs du Wiki des Maires. Merci de saisir l'email utilisé lors de votre enregistrement";
			$result['redirect'] = false;
		}
		return $result;
	}
}