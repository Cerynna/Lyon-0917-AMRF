<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 02/12/17
 * Time: 13:38
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Uploader
{

    private $path;

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     * @return Uploader
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }



}