<?php

namespace App\Modules\Pictures\Domain;

interface ImageStorageInterface
{
    public function saveImage(ImageUploadedFileInterface $imageUploadedFile, int $userId);
}
