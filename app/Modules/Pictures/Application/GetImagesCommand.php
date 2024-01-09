<?php

namespace App\Modules\Pictures\Application;

use App\Modules\Pictures\Application\DTOs\GetImageStorageDTOCollection;
use App\Modules\Pictures\Domain\ImageRepositoryInterface;
use App\Modules\Pictures\Domain\ImageStorageInterface;

class GetImagesCommand implements GetImagesCommandInterface
{

    /**
     * @param ImageRepositoryInterface $imageRepository
     * @param ImageStorageInterface $imageStorage
     */
    public function __construct(private ImageRepositoryInterface $imageRepository, private ImageStorageInterface $imageStorage)
    {
    }

    /**
     * @param int $userId
     * @param int $page
     * @return array
     */
    public function execute(int $userId, int $page){
        $imageRepositoryDTOCollection = $this->imageRepository->getImages($userId, $page);

        $imagesContent = [];

        foreach ($imageRepositoryDTOCollection->collection as $imageRepositoryDTO){

            $imagesContent[] = $this->imageStorage->getImage($imageRepositoryDTO->path);
        }

        return $imagesContent;
    }
}
