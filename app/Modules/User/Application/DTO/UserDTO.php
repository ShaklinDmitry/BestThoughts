<?php

namespace App\Modules\User\Application\DTO;

class UserDTO
{

    /**
     * @param string $login
     * @param string $email
     * @param string $password
     */
    public function __construct(public readonly string $login, public readonly string $email,
                                public readonly string $password)
    {
    }

}
