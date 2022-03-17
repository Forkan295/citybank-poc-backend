<?php

namespace App\Http\Controllers\Api;

use App\Enums\MessageEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\BankResource;
use App\Http\Resources\TransferTypeResource;
use App\Http\Response\ApiResponse;
use App\Models\BankList;
use App\Models\TransactionType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Seshac\Otp\Otp;


class ApiController extends Controller
{

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

    public function getTransferType(): JsonResponse
    {
        try {
            $banks = TransactionType::active()->get();
            return app(ApiResponse::class)->success(TransferTypeResource::collection($banks));
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }

    public function generateOtp()
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


    public function validateOtp(Request $request)
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
