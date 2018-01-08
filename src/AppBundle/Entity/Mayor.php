<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Mayor
 *
 * @ORM\Table(name="mayor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MayorRepository")
 */
class Mayor
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
     * @ORM\Column(name="firstName", type="string", length=255, nullable=true)

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
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)

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
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="insee", type="string", length=255, nullable=true, unique=true)
     */
    private $insee;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)

     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     * @Assert\Email(
     *     message = "Veuillez entrer une adresse email valide",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     * @Assert\Regex(
     *     pattern="/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/",
     *     match=true,
     *     message="Veuillez entrer un numéro au format 0X XX XX XX XX"
     * )
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="town", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     * @Assert\Type(
     *     type= "string")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le nom de votre ville ne peut contenir de chiffre"
     * )
     */
    private $town;

    /**
     * @var string
     *
     * @ORM\Column(name="zipCode", type="string", length=20, nullable=true)

     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
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
     * @ORM\Column(name="department", type="string", length=255, nullable=true)
     */
    private $department;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @var int
     *
     * @ORM\Column(name="population", type="integer", nullable=true)
     *
     * @Assert\Type(
     *     type= "integer"
     * )
     * @Assert\Range(
     *     max=9999,
     *     maxMessage="La population ne peut pas excéder 9999 habitants"
     * )
     */
    private $population;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)

     * @Assert\Url(
     *     message="L'adresse internet n'est pas valide."
     * )
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
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="google", type="string", length=255, nullable=true)
     */
    private $google;

    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="mayor")
     */
    private $projects;


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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Mayor
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Mayor
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Mayor
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
     * Set insee
     *
     * @param string $insee
     *
     * @return Mayor
     */
    public function setInsee($insee)
    {
        $this->insee = $insee;

        return $this;
    }

    /**
     * Get insee
     *
     * @return string
     */
    public function getInsee()
    {
        return $this->insee;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Mayor
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
     * Set phone
     *
     * @param string $phone
     *
     * @return Mayor
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return Mayor
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set zipCode
     *
     * @param integer $zipCode
     *
     * @return Mayor
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return int
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set department
     *
     * @param string $department
     *
     * @return Mayor
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Mayor
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     * @return Mayor
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     * @return Mayor
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Set population
     *
     * @param integer $population
     *
     * @return Mayor
     */
    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }

    /**
     * Get population
     *
     * @return int
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Mayor
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
     * @return Mayor
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
     * Set twitter
     *
     * @param string $twitter
     *
     * @return Mayor
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
     * Set google
     *
     * @param string $google
     *
     * @return Mayor
     */
    public function setGoogle($google)
    {
        $this->google = $google;

        return $this;
    }

    /**
     * Get google
     *
     * @return string
     */
    public function getGoogle()
    {
        return $this->google;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Mayor
     */
    public function addProject(\AppBundle\Entity\Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \AppBundle\Entity\Project $project
     */
    public function removeProject(\AppBundle\Entity\Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }


}
