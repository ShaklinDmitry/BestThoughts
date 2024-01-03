<?php

namespace App\Modules\Pictures\Application;


use App\Modules\Pictures\Application\DTOs\ImageRepositoryDTO;
use App\Modules\Pictures\Domain\ImageUploadedFileInterface;

interface SaveImageCommandInterface
{
    /**
     * @param ImageUploadedFileInterface $file
     * @param int $userId
     * @return ImageRepositoryDTO
     */
    public function execute(ImageUploadedFileInterface $file, int $userId): ImageRepositoryDTO;
}
