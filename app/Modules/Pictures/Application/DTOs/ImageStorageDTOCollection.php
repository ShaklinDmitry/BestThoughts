<?php

namespace App\Modules\Pictures\Application\DTOs;

class ImageStorageDTOCollection
{
    /**
     * @param array $collection
     */
    public function __construct(public readonly array $collection)
    {
    }
}
