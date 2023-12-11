<?php

namespace App\Modules\User\Application\Usecases;

use App\Modules\User\Domain\UserRepositoryInterface;

class CreateUserTokenCommand implements CreateUserTokenCommandInterface
{

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param int $userId
     * @return string
     */
    public function execute(int $userId):string{
        $userToken = $this->userRepository->createUserToken($userId);
        return $userToken;
    }
}
