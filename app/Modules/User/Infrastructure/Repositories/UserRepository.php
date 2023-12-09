<?php

namespace App\Modules\Auth\Infrastructure\Repositories;

use App\Models\User;
use App\Modules\User\Application\DTO\UserDTO;
use App\Modules\User\Domain\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param string $login
     * @param string $email
     * @param string $password
     * @return UserDTO
     */
    public function createUser(string $login, string $email, string $password){
        $user = User::create([
            'login' => $login,
            'email' => $email,
            'password' => $password
        ]);

        return new UserDTO($user->login, $user->email, $user->password);
    }
}
