<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $login = $request->validate([
            'email' => ['email','required'],
            'password' => ['required','string'],
        ]);
        if(!Auth::attempt($login)){
            return response()->json(['message' => 'Invalid credentials'],401);
        };
        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response()->json(['user' => Auth::user(),'access_token' => $accessToken]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration(Request $request): \Illuminate\Http\JsonResponse
    {
        $registration = $request->validate([
            'name' => ['required','string'],
            'email' => ['email','required','unique:users'],
            'password' => ['required','string','confirmed'],
        ]);
        $user = User::create($registration);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json(['user' => $user,'access_token' => $accessToken]);
    }
}
