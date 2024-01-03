<?php

namespace App\Modules\Pictures\Domain;

interface ImageRepositoryInterface
{
    /**
     * @param Image $image
     * @param int $userId
     * @return mixed
     */
    public function saveImage(Image $image, int $userId);
}
