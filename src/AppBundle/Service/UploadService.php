<?php

namespace AppBundle\Service;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadService
{
    const ARRAY_IMG = [
        "jpg", "jpeg", "png",
    ];
    const ARRAY_FILE = [
        "pdf",
    ];
    const SIZE_IMG = 200;

    private $kernelRootDir;

    public function __construct(string $kernelRootDir)
    {
        $this->kernelRootDir = $kernelRootDir;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */

    public function fileUpload($file, $dir, $type)
    {
        switch ($type) {
            case "img":
                if (in_array($file->guessExtension(), self::ARRAY_IMG)) {
                    $imgSource = md5(uniqid()) . '.' . $file->guessExtension();
                    $file->move($this->kernelRootDir . $dir, $imgSource);
                    $imgSource = $this->kernelRootDir . $dir . "/" . $imgSource;
                    list($width, $height) = getimagesize($imgSource);
                    $newHeight = self::SIZE_IMG;
                    $newWidth = round(($width * self::SIZE_IMG) / $height, 0);
                    /*if ($newWidth > self::SIZE_IMG)
                    {
                        $newWidth = self::SIZE_IMG;
                        $newHeight = round(($height * self::SIZE_IMG)/$width, 0);
                    }*/
                    $image_p = imagecreatetruecolor($newWidth, $newHeight);
                    $newImage = md5(uniqid()) . '.jpg';

                    if (pathinfo($imgSource)['extension'] === 'jpg' or pathinfo($imgSource)['extension'] === 'jpeg') {
                        $image = imagecreatefromjpeg($imgSource);
                    }
                    if (pathinfo($imgSource)['extension'] === 'png') {
                        $image = imagecreatefrompng($imgSource);
                    }

                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagejpeg($image_p, $this->kernelRootDir . $dir . "/" . $newImage);
                    $fs = new Filesystem();
                    $fs->remove($imgSource);
                    return $newImage;
                } else {
                    return false;
                }
                break;
            case "file":
                if (in_array($file->guessExtension(), self::ARRAY_FILE)) {
                    $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                    $file->move($this->kernelRootDir . $dir, $fileName);
                    return $fileName;
                } else {
                    return false;
                }
                break;
            default:
                return false;
                break;
        }


    }

}