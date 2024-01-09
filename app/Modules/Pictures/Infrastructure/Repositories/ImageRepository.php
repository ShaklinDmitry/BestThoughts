<?php

namespace App\Modules\Pictures\Infrastructure\Repositories;

use App\Models\ImageEloquent;
use App\Modules\Pictures\Application\DTOs\ImageRepositoryDTO;
use App\Modules\Pictures\Application\DTOs\ImageRepositoryDTOCollection;
use App\Modules\Pictures\Domain\Image;
use App\Modules\Pictures\Domain\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    /**
     * @param Image $image
     * @param int $userId
     * @return ImageRepositoryDTO
     */
    public function saveImage(Image $image, int $userId)
    {
        $imageItem = ImageEloquent::create([
            'guid' => $image->guid,
            'name' => $image->name,
            'path' => $image->path,
            'size' => $image->size,
            'type' => $image->type,
            'user_id' => $userId
        ]);

        return new ImageRepositoryDTO($imageItem->guid, $imageItem->name, $imageItem->path, $imageItem->size, $imageItem->type);
    }

    /**
     * @param int $userId
     * @param int $page
     * @return ImageRepositoryDTOCollection
     */
    public function getImages(int $userId, int $page){
        $images = ImageEloquent::where('user_id', $userId)->skip(9 * ($page-1))->take(10)->get();

        if($images->isEmpty()){
            return new ImageRepositoryDTOCollection([]);
        }

        $collection = [];
        foreach ($images as $image){
            $imageRepositoryDTO = new ImageRepositoryDTO($image->guid, $image->name,
                                                        $image->path, $image->size, $image->type);

            $collection[] = $imageRepositoryDTO;
        }

        $imageRepositoryDTOCollection = new ImageRepositoryDTOCollection($collection);

        return $imageRepositoryDTOCollection;
    }
}
