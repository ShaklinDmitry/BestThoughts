<?php

namespace App\Modules\User\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Application\Usecases\CreateUserTokenCommandInterface;
use App\Modules\User\Application\Usecases\RegisterUserCommandInterface;
use App\Modules\User\Domain\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * @param RegisterUserCommandInterface $registerUserCommand
     * @param CreateUserTokenCommandInterface $createUserTokenCommand
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(private RegisterUserCommandInterface $registerUserCommand,
                                private CreateUserTokenCommandInterface $createUserTokenCommand,
                                private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $userDTO = $this->registerUserCommand->execute($validatedData['name'], $validatedData['email'], Hash::make($validatedData['password']));

        $token = $this->createUserTokenCommand->execute($userDTO->guid);

        return response()->json([
                 "data" => [
                    "message" => "User was registred.",
                    "user" => [
                        'name' => $userDTO->name,
                        'email' => $userDTO->email
                    ],
                    "token" => [
                        'access_token' => $token,
                        'token_type' => 'Bearer'
                    ]
                    ]
            ]
        );

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        try {
            $validatedData = $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);

            if (!Auth::attempt($request->only($validatedData['email'], $validatedData['password']))) {
                return response()->json([
                    'message' => 'Invalid login details',
                ], 401);
            }

            $userDTO = $this->userRepository->getUser($validatedData['email'], $validatedData['password']);

            $token = $this->createUserTokenCommand->execute($userDTO->guid);

            return response()->json([
                    "data" => [
                        "message" => "User has logged in.",
                        "user" => [
                            'name' => $userDTO->name,
                            'email' => $userDTO->email
                        ],
                        "token" => [
                            'access_token' => $token,
                            'token_type' => 'Bearer'
                        ]
                    ]
                ], 200
            );
        }catch(ModelNotFoundException $exception){
            response()->json([
                "data" => [
                    "message" => "There is no users with such email or password"
                ]
            ], 401);
        }



    }

}
