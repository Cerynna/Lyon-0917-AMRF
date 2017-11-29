<?php
/**
 * Created by PhpStorm.
 * User: simont
 * Date: 28/11/2017
 * Time: 14:21
 */

namespace AppBundle\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadService
{
    /**
     * @param UploadedFile $file
     * @return string
     */
    public function fileUpload($file, $dir, $type)
    {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        $file->move('../web/upload' . $dir, $fileName);

        return $fileName;

    }
}