<?php

namespace App\Modules\BestThoughts\Application\DTO;

class BestThoughtDTO
{
    public string $text;
    public string $guid;

    /**
     * @param string $text
     * @param string $guid
     */
    public function __construct(string $text, string $guid)
    {
        $this->text = $text;
        $this->guid = $guid;
    }


}
