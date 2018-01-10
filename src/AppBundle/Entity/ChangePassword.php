<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 20/12/17
 * Time: 16:58
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class ChangePassword
 * @package AppBundle\Entity
 * @ORM\Table(name="forgotPassword")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ForgotPasswordRepository")
 */
class ChangePassword
{
    /**
     * @var "string"
     * @SecurityAssert\UserPassword(
     *     message = "Ce mot de passe ne correspond pas à votre mot de passe actuel"
     * )
     */
    public $oldPassword;

    /**
     * @var "string"
     * @Assert\NotBlank(
     *     message= "Vous devez entrer un nouveau mot de passe, avec au moins 7 caractères, une majuscule, une minuscule et un chiffre "
     * )
     *
     * @Assert\Regex(
     *     pattern="/(?=^.{7,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",
     *     match=true,
     *     message="Votre mot de passe doit comporter au moins 7 caractères, une majuscule, une minuscule et un chiffre"
     * )
     * @Assert\Expression("value != this.login",
     *     message="Votre mot de passe doit être différent de votre n°INSEE ou votre SIREN"
     * )
     */
    public $newPassword;
    /**
     * @var string
     */
    public $email;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     *
     */
    public $idUser;
    /**
     * @var string
     * @ORM\Column(name="token", type="string", length=255, nullable=false)
     *
     */
    public $token;
    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime", nullable=false)
     *
     */
    public $date;
    /**
     * @var int
     * @ORM\Column(name="status", type="integer", nullable=false)
     *
     */
    public $status;


    public $login;

    public function __construct()
    {
        $this->token = bin2hex(random_bytes(32));

    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return ChangePassword
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * @param mixed $oldPassword
     * @return ChangePassword
     */
    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @param mixed $newPassword
     * @return ChangePassword
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     * @return ChangePassword
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ChangePassword
     */
    public function setId(int $id): ChangePassword
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     * @return ChangePassword
     */
    public function setIdUser(int $idUser): ChangePassword
    {
        $this->idUser = $idUser;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return ChangePassword
     */
    public function setToken(string $token): ChangePassword
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return ChangePassword
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return ChangePassword
     */
    public function setStatus(int $status): ChangePassword
    {
        $this->status = $status;
        return $this;
    }


}