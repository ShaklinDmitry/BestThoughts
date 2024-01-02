<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Modules\User\Application\DTO\UserDTO;
use App\Modules\User\Application\Usecases\CreateUserTokenCommand;
use App\Modules\User\Application\Usecases\CreateUserTokenCommandInterface;
use App\Modules\User\Application\Usecases\RegisterUserCommand;
use App\Modules\User\Application\Usecases\RegisterUserCommandInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Mockery\Mock;
use Mockery\MockInterface;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_user_command()
    {
        $name = 'name';
        $email = 'lol@mail.ru';
        $password = '123456789';

        $registerUserCommand = app(RegisterUserCommandInterface::class);
        $userDTO = $registerUserCommand->execute($name, $email, $password);

        $this->assertSame($userDTO->name, $name);
        $this->assertSame($userDTO->email, $email);
    }


    public function test_register_user_api(){

        $name = 'test';
        $email = 'test@mail.ru';
        $password = '123456789';


        $mockRegisterUserCommand = \Mockery::mock(RegisterUserCommand::class);
        $this->app->instance(RegisterUserCommandInterface::class, $mockRegisterUserCommand);
        $mockRegisterUserCommand->shouldReceive('execute')->once()->andReturn(new UserDTO('1234',$name,
            $email,$password));

        $mockCreateUserTokenCommand = \Mockery::mock(CreateUserTokenCommand::class);
        $this->app->instance(CreateUserTokenCommandInterface::class, $mockCreateUserTokenCommand);
        $mockCreateUserTokenCommand->shouldReceive('execute')->once()->andReturn('8da642ba89689');


        $response = $this->post('/api/user',
                                    [
                                        'name' => $name,
                                        'email' => $email,
                                        'password' => $password
                                    ],
                                    ["Accept"=>"application/json"]);


        $response->assertJson(
            [
                "data" => [
                    "message" => "User was registred.",
                    "user" => [
                        'name' => $name,
                        'email' => $email
                    ],
                    "token" => [
                        'access_token' => '8da642ba89689',
                        'token_type' => 'Bearer']
                ]
        ]);

    }
}
