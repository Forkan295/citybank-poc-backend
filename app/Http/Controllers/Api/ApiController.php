<?php

namespace App\Http\Controllers\Api;

use App\Enums\MessageEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\BankResource;
use App\Http\Resources\MobileOperatorResource;
use App\Http\Resources\TransferTypeResource;
use App\Http\Response\ApiResponse;
use App\Models\BankList;
use App\Models\MobileOperator;
use App\Models\TransactionType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Seshac\Otp\Otp;


class ApiController extends Controller
{
    /**
     * @return JsonResponse
     * all bank list info
     */
    public function getBanks(): JsonResponse
    {
        try {
            $banks = BankList::active()->get();
            return app(ApiResponse::class)->success(BankResource::collection($banks));
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }

    /**
     * @return JsonResponse
     * all transaction types
     */
    public function getTransactionType(): JsonResponse
    {
        try {
            $items = TransactionType::active()->get();
            return app(ApiResponse::class)->success(TransferTypeResource::collection($items));
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }

    /**
     * @return JsonResponse
     * all transaction types
     */
    public function getOperators(): JsonResponse
    {
        try {
            $items = MobileOperator::active()->get();
            return app(ApiResponse::class)->success(MobileOperatorResource::collection($items));
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }

    /**
     * @return JsonResponse
     * otp generate
     */
    public function generateOtp(): JsonResponse
    {
        try {
            $user        = auth()->user();
            $otpGenerate = Otp::generate($user->phone);
            $otp         = $otpGenerate->token;
            return app(ApiResponse::class)->success('', 'An otp sent to your mail');
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * validate otp
     */
    public function validateOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required'
        ]);

        if ($validator->fails()) {
            return app(ApiResponse::class)->validationError($validator->errors()->toArray());
        }

        try {
            $user   = auth()->user();
            $verify = Otp::validate($user->phone, $request->otp);

            if (!$verify->status) {
                return app(ApiResponse::class)->error($verify->message);
            }

            return app(ApiResponse::class)->success('', 'OTP successfully match');
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }


}
