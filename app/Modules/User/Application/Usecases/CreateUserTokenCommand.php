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
     * @param string $guid
     * @return string
     */
    public function execute(string $guid):string{
        $userToken = $this->userRepository->createUserToken($guid);
        return $userToken;
    }
}
