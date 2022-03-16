<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MobileOperatorResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Http\Response\ApiResponse;
use App\Models\MobileOperator;
use Illuminate\Http\Request;

class MobileOperatorController extends Controller
{
	/**
     * @return JsonResponse
     */
    public function getOperator()
    {
    	try {
    		$operators = MobileOperator::all();

    		$operatorResource = MobileOperatorResource::collection($operators);

            return app(ApiResponse::class)->success($operatorResource);
        } catch (\Exception $e) {
            Log::error($e);
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }
}
