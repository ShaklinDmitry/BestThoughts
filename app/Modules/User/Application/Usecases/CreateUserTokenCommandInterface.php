<?php

namespace App\Modules\User\Application\Usecases;

interface CreateUserTokenCommandInterface
{
    /**
     * @param string $guid
     * @return string
     */
    public function execute(string $guid):string;
}
