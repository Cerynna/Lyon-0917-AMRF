<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 28/11/17
 * Time: 13:29
 */

namespace AppBundle\Service\Connexion;


class GeneratePwdService
{
    /**
     * Generate a password
     * @param $nbChars = password length

     * @return string
     */
    function generatePassword($nbChars = 7)
    {
        $password = "";

        $string = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";
        $string_length = strlen($string);

        for($i = 1; $i <= $nbChars; $i++)
        {
            $randRank = mt_rand(0,($string_length-1));
            $password .= $string[$randRank];
        }

        return $password;
    }

}