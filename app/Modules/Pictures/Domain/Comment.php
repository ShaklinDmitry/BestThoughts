<?php

namespace App\Modules\Pictures\Domain;

class Comment
{
    public ?string $guid = NULL;

    public function __construct(public readonly string $text)
    {
        if(!$this->guid){
            $this->guid = uniqid();
        }
    }
}
