<?php

namespace App\Http\Controllers\Api;

use App\Enums\MessageEnum;
use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use App\Service\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $authService = new AuthService();

        $validator = Validator::make($request->all(), $authService->basicRules());

        if ($validator->fails()) {
            return app(ApiResponse::class)->validationError($validator->errors());
        }

        try {
            $credential = $authService->matchCredentials($request);
            if (!$credential) {
                return app(ApiResponse::class)->error(MessageEnum::INVALID_CREDENTIAL);
            }
            $accessToken = auth()->user()->createToken('users')->accessToken;
            $user        = $authService->getUserData($request->user());


            return app(ApiResponse::class)->success([ 'access_token' => $accessToken, 'user' => $user]);
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception($e->getMessage());
        }
    }


    public function getProfile(Request $request)
    {
        try {
            $authService = new AuthService();
            $user        = $authService->getUserData($request->user());
            return app(ApiResponse::class)->success($user);
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
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
}
