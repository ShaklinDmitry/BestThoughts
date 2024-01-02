<?php

namespace App\Modules\Pictures\Infrastructure\Repositories;

use App\Modules\Pictures\Domain\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    public function saveImage(string $name, string $path, string $size, string $type, int $userId)
    {
        // TODO: Implement saveImage() method.
    }
}
