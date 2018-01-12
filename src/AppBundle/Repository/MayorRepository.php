<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;

class MayorRepository extends \Doctrine\ORM\EntityRepository
{
    public function MaxMayor()
    {
        $sql = " SELECT COUNT(*) FROM user WHERE role = " . User::USER_ROLE_MAYOR;
        $em = $this->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll()[0]["COUNT(*)"];


    }

    public function ListMayor($offset)
    {
        $mayors =  $this->getEntityManager()
            ->getRepository('AppBundle:User')
            ->createQueryBuilder('u')
            ->setParameter('role', User::USER_ROLE_MAYOR)
            ->where('u.role = :role')
            ->setMaxResults(10)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
        $i = 0 ;
        $return = [];
        foreach ($mayors as $mayor){
            $return[$i]['id'] = $mayor->getId();
            $return[$i]['commune'] = $mayor->getMayor()->getTown();
            $return[$i]['zipcode'] = $mayor->getMayor()->getZipCode();
            $return[$i]['status'] = $mayor->getStatus();
            $return[$i]['email'] = $mayor->getEmail();
            $i++;
        }
        return $return;
    }
    public function MaxPartner()
    {
        $sql = " SELECT COUNT(*) FROM user WHERE role = " . User::USER_ROLE_PARTNER;
        $em = $this->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll()[0]["COUNT(*)"];


    }
    public function ListPartner($offset)
    {
        $partners =  $this->getEntityManager()
            ->getRepository('AppBundle:User')
            ->createQueryBuilder('u')
            ->setParameter('role', User::USER_ROLE_PARTNER)
            ->where('u.role = :role')
            ->setMaxResults(10)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
        $i = 0 ;
        $return = [];
        dump($partners);
        foreach ($partners as $partner){
            $return[$i]['id'] = $partner->getId();
            $return[$i]['name'] = $partner->getPartner()->getCompany()->getName();
            $return[$i]['status'] = $partner->getStatus();
            $return[$i]['email'] = $partner->getEmail();
            $i++;
        }
        return $return;
    }
}
