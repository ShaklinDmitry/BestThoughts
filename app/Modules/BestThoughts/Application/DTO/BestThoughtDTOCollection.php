<?php

namespace App\Modules\BestThoughts\Application\DTO;

class BestThoughtDTOCollection
{
    /**
     * @param array $collection
     */
    public function __construct(private readonly array $collection)
    {
    }


}
