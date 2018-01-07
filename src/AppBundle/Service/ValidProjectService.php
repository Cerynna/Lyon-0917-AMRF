<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 06/01/18
 * Time: 20:33
 */

namespace AppBundle\Service;


use AppBundle\Entity\Project;

class ValidProjectService
{
    private $erreur = [];

    private $idProject;

    private $kernelRootDir;

    public function __construct(string $kernelRootDir)
    {
        $this->kernelRootDir = $kernelRootDir;
    }

    public function Verif(Project $project)
    {
        $this->setIdProject($project->getId());
        // NOT NULL
        $this->verifTitle($project->getTitle());
        $this->verifDescResume($project->getDescResume());
        $this->verifProjectDate($project->getProjectDate());
        $this->verifProjectDuration($project->getProjectDuration());
        $this->verifProjectCost($project->getProjectCost());
        $this->verifDescContext($project->getDescContext());
        $this->verifDescGoal($project->getDescGoal());
        $this->verifDescProgress($project->getDescProgress());
        $this->verifDescPartners($project->getDescPartners());
        $this->verifDescResults($project->getDescResults());
        // VERIF SPECIAL
        $this->verifImage($project->getImages());
        $this->verifFile($project->getFile());
        $this->verifUrl($project->getUrl());
        $this->verifYoutube($project->getYoutube());
        $this->verifFacebook($project->getFacebook());
        $this->verifTwitter($project->getTwitter());
        return $this;

    }

    /**
     * @return mixed
     */
    public function getIdProject()
    {
        return $this->idProject;
    }

    /**
     * @param mixed $idProject
     * @return ValidProjectService
     */
    public function setIdProject($idProject)
    {
        $this->idProject = $idProject;
        return $this;
    }

    /**
     * @return array
     */
    public function getErreur(): array
    {
        return $this->erreur;
    }

    /**
     * @param string $erreur
     * @return ValidProjectService
     */
    public function setErreur($erreur)
    {
        $this->erreur[] = $erreur;
        return $this;
    }


    public function verifTitle($title)
    {
        if (strlen($title) < 2) {
            if ($title == null) {
                $this->setErreur("Votre titre ne doit pas etre vide");
            } else {
                $this->setErreur("Votre titre doit faire au moins de caractère");
            }
        }

    }

    public function verifCreationDate($creationDate)
    {

    }

    public function verifUpdateDate()
    {

    }

    public function verifImage($images)
    {
        if ($images != null) {
            foreach ($images as $image) {
                if (!file_exists($this->kernelRootDir . "/project/" . $this->idProject . "/photos/" . $image)) {
                    $this->setErreur("Le fichier $image n'existe pas.");
                }
            }

        }
    }

    public function verifProjectDate($projectDate)
    {
        if ($projectDate == null) {
            $this->setErreur("L'année de réalisation ne peu pas etre vide");
        }
    }

    public function verifProjectDuration($projectDuration)
    {
        if ($projectDuration == null) {
            $this->setErreur("La durée de réalisation ne peu pas etre vide");
        }
    }

    public function verifProjectCost($projectCost)
    {
        if ($projectCost == null) {
            $this->setErreur("Le coût global ne peu pas etre vide");
        }
    }

    public function verifProjectCoFinancement()
    {

    }

    public function verifDescResume($resume)
    {
        if ($resume == null) {
            $this->setErreur("Le résumé du projet ne peu pas etre vide");
        }
    }

    public function verifDescContext($context)
    {
        if ($context == null) {
            $this->setErreur("Le contexte ne peu pas etre vide");
        }
    }

    public function verifDescGoal($goal)
    {
        if ($goal == null) {
            $this->setErreur("Les objectifs ne peu pas etre vide");
        }
    }

    public function verifDescProgress($progress)
    {
        if ($progress == null) {
            $this->setErreur("Le déroulement ne peu pas etre vide");
        }
    }

    public function verifDescPartners($partner)
    {
        if ($partner == null) {
            $this->setErreur("Les partenaires mobilisés ne peu pas etre vide");
        }
    }

    public function verifDescResults($result)
    {
        if ($result == null) {
            $this->setErreur("Les résultats obtenus ne peu pas etre vide");
        }
    }

    public function verifDescDifficulties()
    {

    }

    public function verifDescAdvices()
    {

    }

    public function verifContactName($name)
    {
        if ($name == null) {
            $this->setErreur("Les Nom et Prénom de la personne qui a pris en charge le projet ne peu pas etre vide");
        }
    }

    public function verifContactOccupation($occupation)
    {
        if ($occupation == null) {
            $this->setErreur("La fonction de la personne qui a pris en charge le projet ne peu pas etre vide");
        }
    }

    public function verifContactEmail($email)
    {
        if ($email == null) {
            $this->setErreur("L'email de la personne qui a pris en charge le projet ne peu pas etre vide");
        }
    }

    public function verifContactPhone($phone)
    {
        if ($phone == null) {
            $this->setErreur("Le n° de téléphone de la personne qui a pris en charge le projet ne peu pas etre vide");
        }
    }

    public function verifFile($file)
    {
        if ($file != null) {
            if (!file_exists($this->kernelRootDir . "/project/" . $this->idProject . "/file/" . $file)) {
                $this->setErreur("Erreur pour le fichier PDF");
            }
        }
    }

    public function verifUrl($url)
    {
        if ($url != null) {
            $pattern = '%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu';
            if (preg_match($pattern, $url) == 0) {
                $this->setErreur("Le lien du site internet n'est pas valide");
            }
        }
    }

    public function verifYoutube($url)
    {
        if ($url != null) {
            $pattern = '/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/';
            if (preg_match($pattern, $url) == 0) {
                $this->setErreur("Le lien Youtube n'est pas valide");
            }
        }
    }

    public function verifFacebook($url)
    {
        if ($url != null) {
            $pattern = '/(?:(?:http|https):\/\/)?(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?/';
            if (preg_match($pattern, $url) == 0) {
                $this->setErreur("Le lien Facebook n'est pas valide");
            }
        }
    }

    public function verifTwitter($url)
    {
        if ($url != null) {
            $pattern = '/http(?:s)?:\/\/(?:www\.)?twitter\.com\/([a-zA-Z0-9_]+)/';
            if (preg_match($pattern, $url) == 0) {
                $this->setErreur("Le lien Twitter n'est pas valide");
            }
        }
    }

    public function verifSlug()
    {

    }
}