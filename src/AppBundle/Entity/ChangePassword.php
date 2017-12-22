<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 20/12/17
 * Time: 16:58
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword
{
    /**
     * @var "string"
     */
    public $oldPassword;

    /**
     * @var "string"
     */
    public $newPassword;

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


}