<?php

namespace AMRF\PublicRooterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="AMRF\PublicRooterBundle\Repository\CompanyRepository")
 */
class Company
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zipCode", type="string", length=20, nullable=true)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="activities", type="string", length=255, nullable=true)
     */
    private $activities;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation", type="text", nullable=true)
     */
    private $presentation;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="linkedin", type="string", length=255, nullable=true)
     */
    private $linkedin;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="contactFirstName", type="string", length=255, nullable=true)
     */
    private $contactFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="contactLastName", type="string", length=255, nullable=true)
     */
    private $contactLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="contactPhone", type="string", length=255, nullable=true)
     */
    private $contactPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="contactEmail", type="string", length=255, nullable=true)
     */
    private $contactEmail;



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
     * Set name
     *
     * @param string $name
     *
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Company
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return Company
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Company
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set activities
     *
     * @param string $activities
     *
     * @return Company
     */
    public function setActivities($activities)
    {
        $this->activities = $activities;

        return $this;
    }

    /**
     * Get activities
     *
     * @return string
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * Set presentation
     *
     * @param string $presentation
     *
     * @return Company
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Company
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Company
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return Company
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set linkedin
     *
     * @param string $linkedin
     *
     * @return Company
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    /**
     * Get linkedin
     *
     * @return string
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return Company
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set contactFirstName
     *
     * @param string $contactFirstName
     *
     * @return Company
     */
    public function setContactFirstName($contactFirstName)
    {
        $this->contactFirstName = $contactFirstName;

        return $this;
    }

    /**
     * Get contactFirstName
     *
     * @return string
     */
    public function getContactFirstName()
    {
        return $this->contactFirstName;
    }

    /**
     * Set contactLastName
     *
     * @param string $contactLastName
     *
     * @return Company
     */
    public function setContactLastName($contactLastName)
    {
        $this->contactLastName = $contactLastName;

        return $this;
    }

    /**
     * Get contactLastName
     *
     * @return string
     */
    public function getContactLastName()
    {
        return $this->contactLastName;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     *
     * @return Company
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     *
     * @return Company
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set favorites
     *
     * @param \AMRF\PublicRooterBundle\Entity\Favorite $favorites
     *
     * @return Company
     */
    public function setFavorites(\AMRF\PublicRooterBundle\Entity\Favorite $favorites = null)
    {
        $this->favorites = $favorites;

        return $this;
    }

    /**
     * Get favorites
     *
     * @return \AMRF\PublicRooterBundle\Entity\Favorite
     */
    public function getFavorites()
    {
        return $this->favorites;
    }

    /**
     * Set favoriteCompany
     *
     * @param \AMRF\PublicRooterBundle\Entity\Favorite $favoriteCompany
     *
     * @return Company
     */
    public function setFavoriteCompany(\AMRF\PublicRooterBundle\Entity\Favorite $favoriteCompany = null)
    {
        $this->favoriteCompany = $favoriteCompany;

        return $this;
    }

    /**
     * Get favoriteCompany
     *
     * @return \AMRF\PublicRooterBundle\Entity\Favorite
     */
    public function getFavoriteCompany()
    {
        return $this->favoriteCompany;
    }
    public function __toString()
    {
        return $this->getName();
    }

}
