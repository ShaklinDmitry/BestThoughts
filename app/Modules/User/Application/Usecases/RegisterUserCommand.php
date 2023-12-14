<?php

namespace App\Modules\User\Application\Usecases;

use App\Modules\User\Application\DTO\UserDTO;
use App\Modules\User\Domain\User;
use App\Modules\User\Domain\UserRepositoryInterface;

class RegisterUserCommand implements RegisterUserCommandInterface
{
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return UserDTO
     */
    public function execute(string $name, string $email, string $password): UserDTO
    {
        $user = new User();

        $userDTO = $this->userRepository->createUser($user->guid, $name, $email, $password);
        return $userDTO;
    }
}
