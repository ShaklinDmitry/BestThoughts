<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Modules\User\Application\DTO\UserDTO;
use App\Modules\User\Application\Usecases\CreateUserTokenCommand;
use App\Modules\User\Application\Usecases\CreateUserTokenCommandInterface;
use App\Modules\User\Domain\UserRepositoryInterface;
use App\Modules\User\Infrastructure\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_user_fail(){
        $name = 'test';
        $email = 'test@mail.ru';
        $password = '123456789';

        User::factory()->create([
            'name' => 'fakeName',
            'email' => 'fakeEmail',
            'password' => Hash::make($password)
        ]);


        $response = $this->post('/api/login',
            [
                'email' => $email,
                'password' => $password
            ],
            ["Accept"=>"application/json"]);

        $response->assertJson(
            [
                'message' => 'Invalid login details',
            ]
        );
    }

    public function test_login_user_success()
    {
        $name = 'test';
        $email = 'test@mail.ru';
        $password = '123456789';

        User::factory()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        $userRepositoryMock = \Mockery::mock(UserRepository::class);
        $this->app->instance(UserRepositoryInterface::class, $userRepositoryMock);
        $userRepositoryMock->shouldReceive('getUser')->andReturn(new UserDTO('1234', $name, $email, Hash::make($password)));

        $mockCreateUserTokenCommand = \Mockery::mock(CreateUserTokenCommand::class);
        $this->app->instance(CreateUserTokenCommandInterface::class, $mockCreateUserTokenCommand);
        $mockCreateUserTokenCommand->shouldReceive('execute')->once()->andReturn('8da642ba89689');


        $response = $this->post('/api/login',
            [
                'email' => $email,
                'password' => $password
            ],
            ["Accept"=>"application/json"]);

        $response->assertJson(
            [
                "data" => [
                    "message" => "User has logged in.",
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
