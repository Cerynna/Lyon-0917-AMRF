<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 26/12/17
 * Time: 20:34
 */

namespace AppBundle\Entity;


use function serialize;

class Search
{

    private $texts;

    private $themas;

    private $keywords;

    private $commune;

    private $region;

    private $departement;

    /**
     * @return mixed
     */
    public function getTexts()
    {
        return $this->texts;
    }

    /**
     * @param mixed $texts
     * @return Search
     */
    public function setTexts($texts)
    {
        $this->texts = $texts;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThemas()
    {
        return $this->themas;
    }

    /**
     * @param mixed $themas
     * @return Search
     */
    public function setThemas($themas)
    {
        $this->themas = $themas;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param mixed $keywords
     * @return Search
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * @param mixed $commune
     * @return Search
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     * @return Search
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * @param mixed $departement
     * @return Search
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;
        return $this;
    }

public function __toString()
{
    return serialize($this->texts);
}


}