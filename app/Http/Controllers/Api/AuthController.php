<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Account;
use App\Enums\MessageEnum;
use App\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Response\ApiResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    public function registration(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return app(ApiResponse::class)->error($validator->errors());
            }

            $user = app(AuthService::class)->register($request);
            $user->accounts()->create([
                'account_no' => Account::generateUniqueAccountNumber(),
                'type_id' => Account::PRIMARY_TYPE_ID,
                'balance' => 3000,
                'is_primary' => true,
                'date_opened' => Carbon::now(),
            ]);

            return app(ApiResponse::class)->success(app(AuthService::class)->getUserData($user),'User registered successfully' );
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION,$e->getMessage());
        }
    }
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $authService = new AuthService();
        $validator   = Validator::make($request->all(), $authService->basicRules());

        if ($validator->fails()) {
            return app(ApiResponse::class)->validationError($validator->errors());
        }

        try {
            $credential = $authService->matchCredentials($request);
            if (!$credential) {
                return app(ApiResponse::class)->error(MessageEnum::INVALID_CREDENTIAL);
            }
            $accessToken = auth()->user()->createToken('users');
            $user        = $authService->getUserData($request->user());
            return app(ApiResponse::class)->success(['access_token' => $accessToken, 'user' => $user]);
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION, $e->getMessage());
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
        try {
            $accessToken = auth()->user()->token();
            $accessToken->revoke();
            return app(ApiResponse::class)->success('', 'Successfully logged out');
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }
}
