<?php

namespace App\Modules\Pictures\Domain;

interface ImageStorageInterface
{
    /**
     * @param ImageUploadedFileInterface $imageUploadedFile
     * @param int $userId
     * @return mixed
     */
    public function saveImage(ImageUploadedFileInterface $imageUploadedFile, int $userId);

    /**
     * @param string $path
     * @return mixed
     */
    public function getImage(string $path);
}
