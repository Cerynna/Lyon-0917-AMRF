<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 09/01/18
 * Time: 16:46
 */

namespace AppBundle\Repository;


class ForgotPasswordRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByToken($token)
    {
        return $this->createQueryBuilder('f')
            ->setParameter('token', $token)
            ->where('f.token = :token')
            ->getQuery()
            ->getResult();
    }
}