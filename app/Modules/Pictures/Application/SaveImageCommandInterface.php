<?php

namespace App\Modules\Pictures\Application;


use App\Modules\Pictures\Application\DTOs\ImageDTO;
use App\Modules\Pictures\Domain\ImageUploadedFileInterface;

interface SaveImageCommandInterface
{
    /**
     * @param ImageUploadedFileInterface $file
     * @param int $userId
     * @return ImageDTO
     */
    public function execute(ImageUploadedFileInterface $file, int $userId): ImageDTO;
}
