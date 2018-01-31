<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
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
     * @Assert\Type(
     *     type= "string")
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     *
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     * @Assert\Type(
     *     type= "string")
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zipCode", type="string", length=20, nullable=true)
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     * @Assert\Type(
     *     type= "string")
     * @Assert\Regex(
     *     pattern="/^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/",
     *     match=true,
     *     message="Veuillez entrer un code postal à 5 chiffres"
     * )
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     *
     * @Assert\Type(
     *     type= "string")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="La ville ne peut contenir de chiffre"
     * )
     */
    private $city;

    /**
     * Many Project have many themes
     *
     * @ManyToMany(targetEntity="Dictionary")
     * @JoinTable(name="company_activity",
     *      joinColumns={@JoinColumn(name="id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="activity", referencedColumnName="id")}
     *      )
     */
    private $activities;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation", type="text", nullable=true)
     * @Assert\Type(
     *     type= "string")
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     * @Assert\Length(
     *     max= 1600,
     *     maxMessage="La description ne peut excéder 1600 caractères"
     * )
     *
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
     * @Assert\Type(
     *     type= "string")
     * @Assert\Url(
     *     message="L'adresse internet n'est pas valide.")
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     * @Assert\Type(
     *     type= "string")
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
     * @Assert\Type(
     *     type= "string")
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="contactFirstName", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     * @Assert\Type(
     *     type= "string")
     * @Assert\Length(
     *     min= 2,
     *     minMessage="Votre prénom doit comporter au moins 2 caractères"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre prénom ne peut contenir de chiffre"
     * )
     */
    private $contactFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="contactLastName", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     * @Assert\Type(
     *     type= "string")
     * @Assert\Length(
     *     min= 2,
     *     minMessage="Votre nom doit comporter au moins 2 caractères"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut contenir de chiffre"
     * )
     */
    private $contactLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="contactPhone", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     * @Assert\Regex(
     *     pattern="/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/",
     *     match=true,
     *     message="Veuillez entrer un numéro au format 0X XX XX XX XX"
     * )
     */
    private $contactPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="contactEmail", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     * @Assert\Email(
     *     message = "Veuillez entrer une adresse email valide",
     *     checkMX = false
     * )
     */
    private $contactEmail;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="slug", type="string", length=255, nullable=true)
	 */
	private $slug;

    /**
     * @ORM\OneToMany(targetEntity="Favorite", mappedBy="company")
     */
    private $favorites;

	/**
	 * @return string
	 */
	public function __toString(){
		return $this->name;
	}

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
     * @param array $activities
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
     * @return ArrayCollection
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
     * Constructor
     */
    public function __construct()
    {
        $this->activities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add activity
     *
     * @param \AppBundle\Entity\Dictionary $activity
     *
     * @return Company
     */
    public function addActivity(\AppBundle\Entity\Dictionary $activity)
    {
        $this->activities[] = $activity;

        return $this;
    }

    /**
     * Remove activity
     *
     * @param \AppBundle\Entity\Dictionary $activity
     */
    public function removeActivity(\AppBundle\Entity\Dictionary $activity)
    {
        $this->activities->removeElement($activity);
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Company
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * Add favorite.
     *
     * @param \AppBundle\Entity\Favorite $favorite
     *
     * @return Company
     */
    public function addFavorite(\AppBundle\Entity\Favorite $favorite)
    {
        $this->favorites[] = $favorite;

        return $this;
    }

    /**
     * Remove favorite.
     *
     * @param \AppBundle\Entity\Favorite $favorite
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFavorite(\AppBundle\Entity\Favorite $favorite)
    {
        return $this->favorites->removeElement($favorite);
    }

    /**
     * Get favorites.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavorites()
    {
        return $this->favorites;
    }
}
