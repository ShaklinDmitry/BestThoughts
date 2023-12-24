<?php

namespace App\Modules\User\Infrastructure\Repositories;

use App\Models\User;
use App\Modules\User\Application\DTO\UserDTO;
use App\Modules\User\Domain\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param string $guid
     * @param string $name
     * @param string $email
     * @param string $password
     * @return UserDTO
     */
    public function createUser(string $guid, string $name, string $email, string $password){
        $user = User::create([
            'guid' => $guid,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        return new UserDTO($user->guid, $user->name, $user->email, $user->password);
    }

    /**
     * @param string $guid
     * @return string
     */
    public function createUserToken(string $guid):string{
        $user = User::where('guid', $guid)->first();
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }


    /**
     * @param string $email
     * @param string $password
     * @return UserDTO
     */
    public function getUser(string $email, string $password): UserDTO{
        $user = User::where([
            'email' => $email,
            'password' => $password
        ])->firstOrFail();

        return new UserDTO($user->guid, $user->name, $user->email, $user->password);
    }

}
