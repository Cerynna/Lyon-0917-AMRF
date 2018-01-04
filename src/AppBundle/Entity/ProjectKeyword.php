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
 * @ORM\Table(name="project_keywords")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class ProjectKeyword
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="keyWords", type="integer")
     */
    private $keyword;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ProjectKeyword
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param int $keyword
     * @return ProjectKeyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
        return $this;
    }



}