<?php

namespace App\Modules\Pictures\Infrastructure\Repositories;

use App\Models\ImageEloquent;
use App\Modules\Pictures\Application\DTOs\ImageRepositoryDTO;
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
}
