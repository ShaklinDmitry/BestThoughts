<?php

namespace App\Modules\User\Infrastructure\Repositories;

use App\Models\User;
use App\Modules\User\Application\DTO\UserDTO;
use App\Modules\User\Domain\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return UserDTO
     */
    public function createUser(string $name, string $email, string $password){
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        return new UserDTO($user->name, $user->email, $user->password);
    }

    /**
     * @param int $userId
     * @return string
     */
    public function createUserToken(int $userId):string{
        $user = User::find($userId);
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }

}
