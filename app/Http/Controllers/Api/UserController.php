<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserAccountResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $login = $request->validate([
            'email'    => ['email', 'required'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($login)) {
            return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        };
        $accessToken = Auth::user()->createToken('users')->accessToken;
        return response()->json(['user' => Auth::user(), 'access_token' => $accessToken], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function registration(Request $request): JsonResponse
    {
        $registration = $request->validate([
            'name'     => ['required', 'string'],
            'email'    => ['email', 'required', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
        $user         = User::create($registration);
        $accessToken  = $user->createToken('authToken')->accessToken;
        return response()->json(['user' => $user, 'access_token' => $accessToken]);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $accessToken = auth()->user()->token();
        $accessToken->revoke();
        return response()->json(['message' => 'Successfully logged out'], Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function getUser(): JsonResponse
    {
        return response()->json(['user' => new UserResource(auth()->user())], Response::HTTP_OK);
    }

    public function getAccounts(): JsonResponse
    {
        return response()->json(['user' => UserAccountResource::collection(auth()->user()->accounts)], Response::HTTP_OK);
    }
}
