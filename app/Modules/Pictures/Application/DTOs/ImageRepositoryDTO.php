<?php

namespace App\Modules\Pictures\Application\DTOs;

class ImageRepositoryDTO
{
    /**
     * @param string $guid
     * @param string $name
     * @param string $path
     * @param string $size
     * @param string $type
     */
    public function __construct(public readonly string $guid, public readonly string $name, public readonly string $path,
                                public readonly string $size, public readonly string $type)
    {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

}
