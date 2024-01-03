<?php

namespace App\Modules\Pictures\Application;

use App\Modules\Pictures\Application\DTOs\ImageRepositoryDTO;
use App\Modules\Pictures\Application\DTOs\ImageStorageDTO;
use App\Modules\Pictures\Domain\Image;
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
     * @return ImageRepositoryDTO
     */
    public function execute(ImageUploadedFileInterface $imageUploadedFile, int $userId):ImageRepositoryDTO
    {
        $imageStorageDTO = $this->imageStorage->saveImage($imageUploadedFile, $userId);

        $image = new Image($imageStorageDTO->name, $imageStorageDTO->path, $imageStorageDTO->size, $imageStorageDTO->type);

        $imageRepositoryDTO = $this->imageRepository->saveImage($image, $userId);

        return $imageRepositoryDTO;
    }
}
