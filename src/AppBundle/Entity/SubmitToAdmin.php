<?php
/**
 * Created by PhpStorm.
 * User: cerynna
 * Date: 06/12/17
 * Time: 10:31
 */

namespace AppBundle\Entity;


class SubmitToAdmin
{
    private $status;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return SubmitToAdmin
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }



}