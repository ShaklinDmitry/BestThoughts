<?php

namespace App\Modules\Pictures\Domain;

class Image
{

    /**
     * @var string|null
     */
    public ?string $guid = NULL;

    /**
     * @param string $name
     * @param string $path
     * @param string $size
     * @param string $type
     */
    public function __construct(public readonly string $name, public readonly string $path,
                                public readonly string $size, public readonly string $type)
    {
        if(!$this->guid){
            $this->guid = uniqid();
        }
    }
}
