<?php

namespace AppBundle\Repository;


/**
 * ProjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectRepository extends \Doctrine\ORM\EntityRepository
{

    const MAX_PROJECT = 3;

    public function getLastProject()
    {
        $qb = $this->createQueryBuilder('p')
            ->orderBy("p.updateDate", "DESC")
            ->setMaxResults(self::MAX_PROJECT)
            ->getQuery();
        return $qb->getResult();
    }

    public function getImageProject($idProject)
    {
        return $this->createQueryBuilder('p')
            ->setParameter('id', $idProject)
            ->where('p.id = :id')
            ->select('p.images')
            ->getQuery()
            ->getResult();
    }

}