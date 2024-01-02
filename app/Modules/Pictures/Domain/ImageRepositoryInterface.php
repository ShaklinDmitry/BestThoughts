<?php

namespace App\Modules\Pictures\Domain;

interface ImageRepositoryInterface
{
    /**
     * @param string $name
     * @param string $path
     * @param string $size
     * @param string $type
     * @param int $userId
     * @return mixed
     */
    public function saveImage(string $name, string $path, string $size, string $type, int $userId);
}
