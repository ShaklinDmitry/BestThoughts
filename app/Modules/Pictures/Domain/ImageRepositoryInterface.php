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

    /**
     * @param int $userId
     * @param int $page
     * @return mixed
     */
    public function getImages(int $userId, int $page);
}
