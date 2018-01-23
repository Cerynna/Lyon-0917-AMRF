<?php

namespace AppBundle\Repository;

/**
 * FavoriteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FavoriteRepository extends \Doctrine\ORM\EntityRepository
{
    public function getFavoriteByUserId($idUser)
    {
        return $this->createQueryBuilder('f')
            ->setParameter('idUser', $idUser)
            ->where('f.user = :idUser')
            ->getQuery()
            ->getResult();
    }

    public function getFavorite($type, $idType, $idUser)
    {
        return $this->createQueryBuilder('f')
            ->setParameter('idUser', $idUser)
            ->setParameter('idType', $idType)
            ->where('f.user = :idUser')
            ->andWhere('f.' . $type . ' = :idType')
            ->getQuery()
            ->getResult();
    }

    public function getFavoriteToArray($userId){
        $FavoriteByUserId = $this->getFavoriteByUserId($userId);
        $result = [];

        if ($result != null) {
			foreach ($FavoriteByUserId as $favorite) {
				$result[] = $favorite->getCompany()->getId();
			}
		}
        return $result;
    }
}
