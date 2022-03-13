<?php

namespace App\Http\Controllers\Api;

use App\Enums\MessageEnum;
use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use App\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class AccountController extends Controller
{
    public function getAccounts(Request $request)
    {
        try {
            $authService = new AuthService();
            $accounts    = $authService->getUserAccounts($request->user());
            return app(ApiResponse::class)->success(['items' => $accounts]);
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }
}
