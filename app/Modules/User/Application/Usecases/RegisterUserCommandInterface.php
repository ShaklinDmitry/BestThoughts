<?php

namespace App\Modules\User\Application\Usecases;

use App\Modules\User\Application\DTO\UserDTO;

interface RegisterUserCommandInterface
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return UserDTO
     */
    public function execute(string $name, string $email, string $password):UserDTO;
}
