<?php

namespace App\Modules\BestThoughts\Application\DTO;

class BestThoughtDTOCollection
{
    private array $collection;

    /**
     * @param array $collection
     */
    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }


}
