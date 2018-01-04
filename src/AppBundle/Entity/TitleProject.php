<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 04/12/17
 * Time: 17:33
 */

namespace AppBundle\Entity;


class TitleProject
{

    /**
     * @var string
     * @Assert\Type(
     *     type= "string")
     * @Assert\Length(
     *     min= 5,
     *     minMessage="Le titre doit comporter au moins 5 caractères"
     * )
     */
    private $title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return TitleProject
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

}