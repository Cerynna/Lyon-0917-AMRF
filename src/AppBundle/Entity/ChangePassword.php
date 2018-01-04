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
     *     message="Votre mot de passe doit être différent de votre n°INSEE ou votre SIRET"
     * )
     */
    public $newPassword;

    public $login;

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


}