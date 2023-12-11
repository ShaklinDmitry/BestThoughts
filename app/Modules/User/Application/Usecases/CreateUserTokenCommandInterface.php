<?php

namespace App\Modules\User\Application\Usecases;

interface CreateUserTokenCommandInterface
{
    /**
     * @param int $userId
     * @return mixed
     */
    public function execute(int $userId):string;
}
