<?php

namespace AMRF\PublicRooterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favorite
 *
 * @ORM\Table(name="favorite")
 * @ORM\Entity(repositoryClass="AMRF\PublicRooterBundle\Repository\FavoriteRepository")
 */
class Favorite
{
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
     *
     * @ORM\Column(name="idUser", type="integer")
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="idProject", type="integer", nullable=true)
     */
    private $idProject;

    /**
     * @var int
     *
     * @ORM\Column(name="idPart", type="integer", nullable=true)
     */
    private $idPart;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Favorite
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idProject
     *
     * @param integer $idProject
     *
     * @return Favorite
     */
    public function setIdProject($idProject)
    {
        $this->idProject = $idProject;

        return $this;
    }

    /**
     * Get idProject
     *
     * @return int
     */
    public function getIdProject()
    {
        return $this->idProject;
    }

    /**
     * Set idPart
     *
     * @param integer $idPart
     *
     * @return Favorite
     */
    public function setIdPart($idPart)
    {
        $this->idPart = $idPart;

        return $this;
    }

    /**
     * Get idPart
     *
     * @return int
     */
    public function getIdPart()
    {
        return $this->idPart;
    }
}

