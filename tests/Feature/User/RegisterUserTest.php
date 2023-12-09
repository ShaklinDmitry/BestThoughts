<?php

namespace Tests\Feature\User;

use App\Modules\User\Application\Usecases\RegisterUserCommandInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_user()
    {
        $name = 'name';
        $email = 'lol@mail.ru';
        $password = Hash::make('password');

        $registerUserCommand = app(RegisterUserCommandInterface::class);
        $userDTO = $registerUserCommand->execute($name, $email, $password);

        $this->assertSame($userDTO->name, $name);
        $this->assertSame($userDTO->email, $email);
        $this->assertSame($userDTO->password, $password);
    }
}
