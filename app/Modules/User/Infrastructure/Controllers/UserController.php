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
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'messages' => 'The given data was invalid.', 'errors' => $validator->errors()]);
        }

        $validatedData = $validator->validated();

        $userDTO = $this->registerUserCommand->execute($validatedData['name'], $validatedData['email'], $validatedData['password']);

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

            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'message' => 'Invalid login details',
                ], 401);
            }

            $userDTO = $this->userRepository->getUser($request->email, $request->password);

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
        }catch (\Exception $exception){
            response()->json([
                "data" => [
                    "message" => $exception->getMessage()
                ]
            ]);
        }

    }

}
