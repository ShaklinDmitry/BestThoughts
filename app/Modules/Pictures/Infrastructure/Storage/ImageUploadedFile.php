<?php

namespace App\Modules\Pictures\Infrastructure\Storage;

use App\Modules\Pictures\Domain\ImageUploadedFileInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadedFile implements ImageUploadedFileInterface
{
    private UploadedFile $uploadedFile;

    /**
     * @param UploadedFile $uploadedFile
     */
    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * @return UploadedFile
     */
    public function getUploadedFile(): UploadedFile
    {
        return $this->uploadedFile;
    }


}
