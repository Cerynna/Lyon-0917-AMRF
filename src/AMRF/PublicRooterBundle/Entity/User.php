<?php

namespace AMRF\PublicRooterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AMRF\PublicRooterBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User
{


    const USER_ROLE_MAYOR   = 1;
    const USER_ROLE_PARTNER = 2;
    const USER_ROLE_ADMIN   = 3;

    const USER_STATUS_ACTIF     = 1;
    const USER_STATUS_INACTIF   = 2;
    const USER_STATUS_DELETE    = 3;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, unique=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="role", type="integer")
     */
    private $role;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastLogin", type="datetime")
     */
    private $lastLogin;

    /**
     * @ORM\OneToOne(targetEntity="Mayor", cascade={"persist"})
     */
    private $mayor;

    /**
     * @ORM\OneToOne(targetEntity="Partner", cascade={"persist"})
     */
    private $partner;

    /**
     * @ORM\OneToMany(targetEntity="Favorite", mappedBy="user")
     */
    private $favorites;


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
     * Set login
     *
     * @param string $login
     *
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set role
     *
     * @param integer $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return User
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set lastLogin
     *
     * @param string $lastLogin
     *
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return string
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set mayor
     *
     * @param \AMRF\PublicRooterBundle\Entity\Mayor $mayor
     *
     * @return User
     */
    public function setMayor(\AMRF\PublicRooterBundle\Entity\Mayor $mayor = null)
    {
        $this->mayor = $mayor;

        return $this;
    }

    /**
     * Get mayor
     *
     * @return \AMRF\PublicRooterBundle\Entity\Mayor
     */
    public function getMayor()
    {
        return $this->mayor;
    }

    /**
     * Set partner
     *
     * @param \AMRF\PublicRooterBundle\Entity\Partner $partner
     *
     * @return User
     */
    public function setPartner(\AMRF\PublicRooterBundle\Entity\Partner $partner = null)
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * Get partner
     *
     * @return \AMRF\PublicRooterBundle\Entity\Partner
     */
    public function getPartner()
    {
        return $this->partner;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->favorites = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add favorite
     *
     * @param \AMRF\PublicRooterBundle\Entity\Favorite $favorite
     *
     * @return User
     */
    public function addFavorite(\AMRF\PublicRooterBundle\Entity\Favorite $favorite)
    {
        $this->favorites[] = $favorite;

        return $this;
    }

    /**
     * Remove favorite
     *
     * @param \AMRF\PublicRooterBundle\Entity\Favorite $favorite
     */
    public function removeFavorite(\AMRF\PublicRooterBundle\Entity\Favorite $favorite)
    {
        $this->favorites->removeElement($favorite);
    }

    /**
     * Get favorites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavorites()
    {
        return $this->favorites;
    }
}
