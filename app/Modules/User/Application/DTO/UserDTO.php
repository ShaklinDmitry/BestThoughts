<?php

namespace App\Modules\User\Application\DTO;

class UserDTO
{

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(public readonly string $name, public readonly string $email,
                                public readonly string $password)
    {
    }

}
