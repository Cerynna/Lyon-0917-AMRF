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
		$mayors = $this->getEntityManager()
			->getRepository('AppBundle:User')
			->createQueryBuilder('u')
			->setParameter('role', User::USER_ROLE_MAYOR)
			->where('u.role = :role')
			->orderBy('u.login', 'ASC')
			->setMaxResults(10)
			->setFirstResult($offset)
			->getQuery()
			->getResult();
		$i = 0;
		$return = [];
		foreach ($mayors as $mayor) {
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
		return $stmt->fetchAll()[0]["COUNT(*)"] + 1;
	}

	public function ListPartner($offset)
	{
		$partners = $this->getEntityManager()
			->getRepository('AppBundle:User')
			->createQueryBuilder('u')
			->setParameter('role', User::USER_ROLE_PARTNER)
			->where('u.role = :role')
			->setMaxResults(10)
			->setFirstResult($offset)
			->getQuery()
			->getResult();
		$i = 0;
		$return = [];
		foreach ($partners as $partner) {
			$return[$i]['id'] = $partner->getId();
			$return[$i]['name'] = $partner->getPartner()->getCompany()->getName();
			$return[$i]['zipcode'] = $partner->getPartner()->getCompany()->getZipCode();
			$return[$i]['status'] = $partner->getStatus();
			$return[$i]['email'] = $partner->getEmail();
			$i++;
		}
		return $return;
	}

	public function ListMayorFilter($zipCode, $insee)
	{
		$query = $this->getEntityManager()
			->getRepository('AppBundle:Mayor')
			->createQueryBuilder('m')
			->select('m.id');
		if (!empty($zipCode)) {
			$query->setParameter(':zipCode', $zipCode . '%')
				->where('m.zipCode LIKE :zipCode');
		}
		if (!empty($zipCode) AND !empty($insee)) {
			$query->setParameter(':insee', $insee . '%')
				->orWhere('m.insee LIKE :insee');
		}
		if (empty($zipCode) AND !empty($insee)) {
			$query->setParameter(':insee', $insee . '%')
				->where('m.insee LIKE :insee');
		}
		$mayors = $query->getQuery()
			->getResult();
		$sql = "SELECT u FROM AppBundle:User u ";
		$i = 0;
		foreach ($mayors as $mayor) {
			$operateur = " OR ";
			if ($i == 0) {
				$operateur = " WHERE ";
			}
			$sql .= $operateur . "u.mayor = " . $mayor['id'] . "";
			$i++;
		}
		$results = $this->getEntityManager()
			->createQuery($sql)
			->getResult();
		$i = 0;
		$return = [];
		foreach ($results as $mayor) {
			$return[$i]['id'] = $mayor->getId();
			$return[$i]['commune'] = $mayor->getMayor()->getTown();
			$return[$i]['zipcode'] = $mayor->getMayor()->getZipCode();
			$return[$i]['status'] = $mayor->getStatus();
			$return[$i]['email'] = $mayor->getEmail();
			$i++;
		}
		return $return;
	}
}
