<?php

namespace App\Modules\Pictures\Application;

use App\Modules\Pictures\Application\DTOs\ImageDTO;
use App\Modules\Pictures\Domain\ImageRepositoryInterface;
use App\Modules\Pictures\Domain\ImageStorageInterface;
use App\Modules\Pictures\Domain\ImageUploadedFileInterface;

class SaveImageCommand implements SaveImageCommandInterface
{

    /**
     * @param ImageRepositoryInterface $imageRepository
     * @param ImageStorageInterface $imageStorage
     */
    public function __construct(private ImageRepositoryInterface $imageRepository,
                                private ImageStorageInterface $imageStorage)
    {
    }

    /**
     * @param ImageUploadedFileInterface $imageUploadedFile
     * @param int $userId
     * @return ImageDTO
     */
    public function execute(ImageUploadedFileInterface $imageUploadedFile, int $userId): ImageDTO
    {
        $imageDTO = $this->imageStorage->saveImage($imageUploadedFile, $userId);

        return $imageDTO;
    }
}
