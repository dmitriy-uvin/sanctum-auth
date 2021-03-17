<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Auth\LoginHttpRequest;
use App\Http\Requests\Api\Auth\RegisterHttpRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    private const API_TOKEN_NAME = 'api_token';

    public function register(RegisterHttpRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email
        ]);

        return $this->successResponse([
            'token' => $user->createToken(self::API_TOKEN_NAME)->plainTextToken
        ]);
    }

    public function login(LoginHttpRequest $request): JsonResponse
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {
            return $this->errorResponse(
                'Credentials not match',
                JsonResponse::HTTP_UNAUTHORIZED
            );
        }

        $token = auth()->user()->createToken(self::API_TOKEN_NAME)->plainTextToken;

        return $this->successResponse([
            'token' => $token
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return $this->successResponse([],
            'Logged out!'
        );
    }
}
