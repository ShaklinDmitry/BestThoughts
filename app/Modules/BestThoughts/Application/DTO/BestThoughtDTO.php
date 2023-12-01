<?php

namespace App\Modules\BestThoughts\Application\DTO;

class BestThoughtDTO
{

    /**
     * @param string $text
     * @param string $guid
     * @param int $userId
     */
    public function __construct(public readonly string $text, public readonly string $guid, public readonly int $userId)
    {
    }

}
