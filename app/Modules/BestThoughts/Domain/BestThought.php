<?php

namespace App\Modules\BestThoughts\Domain;

class BestThought
{
    public ?string $guid = NULL;

    public function __construct()
    {
        if(!$this->guid){
            $this->guid = uniqid();
        }
    }
}
