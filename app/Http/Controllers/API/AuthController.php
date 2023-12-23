<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Repository\Contract\UserRepositoryInterface;

class AuthController extends Controller
{

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepo;

    /**
     * __construct
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(RegisterRequest $request)
    {
        // Create the user
        $user = $this->userRepo->createUser($request->validated());

        // Respond with the user and token
        return response()->json([
            'user' => UserResource::make($user),
            'token' => $user->createToken('auth_token')->plainTextToken, // Generate the token
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $attempt = $this->userRepo->login($request->email, $request->password);
        if ($attempt) {
            $user = $this->userRepo->findByEmail($request->email);
            return $this->responseSuccess([
                'user' => UserResource::make($user),
                'token' => $user->createToken('auth_token')->plainTextToken,
            ]);
        } else {
            return  $this->responseError(__('errors.credentialsDoNotMatch'));
        }
    }
}
