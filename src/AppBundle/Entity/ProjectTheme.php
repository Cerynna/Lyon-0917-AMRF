<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 26/12/17
 * Time: 19:44
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Project
 *
 * @ORM\Table(name="project_theme")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class ProjectTheme
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="themes", type="integer")
     */
    private $themes;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ProjectTheme
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * @param mixed $themes
     * @return ProjectTheme
     */
    public function setThemes($themes)
    {
        $this->themes = $themes;
        return $this;
    }


}