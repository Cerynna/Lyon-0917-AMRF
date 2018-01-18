<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Partner
 *
 * @ORM\Table(name="partner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartnerRepository")
 */
class Partner
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
     *      pattern="/[0-9]/",
     *     match=false,
     *     message="Votre prénom ne peut contenir de chiffre"
     * )
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     * @Assert\Type(
     *     type= "string")
     * @Assert\Length(
     *     min=2,
     *     minMessage="Votre nom doit comporter au moins 2 caractères"
     * )
     * @Assert\Regex(
     *     pattern="/([0-9])/",
     *     match=false,
     *     message="Votre prénom ne peut contenir de chiffre"
     * )
     *
     */
    private $lastName;


    /**
     *
     * @var string
     *
     * @ORM\Column(name="occupation", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     * @Assert\Length(
     *     min= 5,
     *     minMessage="Votre fonction doit comporter au moins 5 caractères"
     * )
     */
    private $occupation;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
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
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(
     *     message= "Cette information est obligatoire"
     * )
     * @Assert\Email(
     *     message = "Veuillez entrer une adresse email valide",
     *     checkMX = false
     * )
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity="Company")
     */
    private $company;

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
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Partner
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Partner
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get occupation
     *
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Set occupation
     *
     * @param string $occupation
     *
     * @return Partner
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

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
     * Set phone
     *
     * @param string $phone
     *
     * @return Partner
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

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
     * Set email
     *
     * @param string $email
     *
     * @return Partner
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get company
     *
     * @return \AppBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set company
     *
     * @param \AppBundle\Entity\Company $company
     *
     * @return Partner
     */
    public function setCompany(\AppBundle\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }
}
