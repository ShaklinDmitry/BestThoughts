<?php

namespace App\Modules\User\Domain;

class User
{
    public readonly string $guid;

    /**
     * @param string $guid
     */
    public function __construct(string $guid = NULL)
    {
        if($guid == NULL){
            $this->guid = uniqid();
        }else{
            $this->guid = $guid;
        }
    }


}
