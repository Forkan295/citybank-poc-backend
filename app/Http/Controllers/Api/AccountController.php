<?php

namespace App\Http\Controllers\Api;

use App\Enums\MessageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransferRequest;
use App\Http\Response\ApiResponse;
use App\Service\AuthService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Seshac\Otp\Otp;


class AccountController extends Controller
{

    public function getAccounts(Request $request): JsonResponse
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


    public function balanceTransfer(TransferRequest $request): JsonResponse
    {
        try {
            $user           = auth('api')->user();
            $primaryAccount = $user->accounts()->isPrimaryAccount()->first();
            $amount         = data_get($request, 'amount');
            $prepareData    = app(AuthService::class)->prepareTransactionData($request, $primaryAccount);
            $verify         = Otp::validate($user->phone, $request->otp);

            if (!$verify->status) {
                return app(ApiResponse::class)->error($verify->message);
            }

            if ($primaryAccount->balance < $amount) {
                return app(ApiResponse::class)->error(MessageEnum::INSUFFICIENT_AMOUNT);
            }

            $create = $user->transactions()->create($prepareData);

            if ($create) {
                $primaryAccount->decrement('balance', $amount);
            }
            return app(ApiResponse::class)->success('', MessageEnum::SUCCESS);
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }

    public function getTransactions(Request $request): JsonResponse
    {
        try {
            $authService = new AuthService();
            $accounts    = $authService->getAccountTransaction($request->user());
            return app(ApiResponse::class)->success(['items' => $accounts]);
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }


}
