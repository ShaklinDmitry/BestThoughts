<?php

namespace Tests\Feature\User;

use App\Modules\Auth\Application\Usecases\RegisterUserCommandInterface;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{

    public function test_register_user()
    {
        $login = 'login';
        $password = 'password';

        $registerUserCommand = app(RegisterUserCommandInterface::class);
        $userDTO = $registerUserCommand->execute($login, $password);

        $this->assertSame($userDTO->login, $login);
    }
}
