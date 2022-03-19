<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\RechargeRequest;
use App\Http\Controllers\Controller;
use App\Service\RechargeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Response\ApiResponse;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionType;
use App\Models\MobileOperator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Enums\MessageEnum;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Seshac\Otp\Otp;
use Carbon\Carbon;

class RechargeController extends Controller
{


    public function balanceRecharge(RechargeRequest $request): JsonResponse
    {
        try {
            $user        = auth('api')->user();
            $userAccount = $user->accounts()->isPrimaryAccount()->first();
            $amount      = data_get($request, 'recharge_amount');
            $prepareData = app(RechargeService::class)->prepareTransactionData($request, $userAccount);
            $verifyOtp   = Otp::validate($user->phone, $request->otp);

            //verify otp
            if (!$verifyOtp->status) {
                return app(ApiResponse::class)->error($verifyOtp->message);
            }

            //check available balance
            if ($userAccount->balance < $amount) {
                return app(ApiResponse::class)->error(MessageEnum::INSUFFICIENT_AMOUNT);
            }

            //transaction create
            $transaction = $user->transactions()->create($prepareData);

            if ($transaction) {
                $rechargeInfo = app(RechargeService::class)->prepareRechargeData($request);
                $userAccount->decrement('balance', $amount);
                $transaction->recharge()->create($rechargeInfo);
            }

            return app(ApiResponse::class)->success('', MessageEnum::SUCCESS);
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }


}
