<?php
/**
 * Created by PhpStorm.
 * User: mar
 * Date: 27/11/17
 * Time: 14:23
 */

namespace AMRF\PublicRooterBundle\Services;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class Upload
{
    public function upload(UploadedFile $file)
    {
       $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move( '../../../../web/upload', $fileName);

        return $fileName;


    }
}