<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadService
{
    /**
     * @param UploadedFile $file
     * @return string
     */
    public function fileUpload($file, $dir)
    {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move('../web/upload' . $dir, $fileName);

        return $fileName;
    }
}