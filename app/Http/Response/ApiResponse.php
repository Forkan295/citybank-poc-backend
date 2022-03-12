<?php


namespace App\Http\Response;


use App\Enums\ResponseStatus;
use App\Enums\ResponseStatusCode;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{

    public function validationError(
        $messages = [],
        $data = [],
        $responseCode = Response::HTTP_UNPROCESSABLE_ENTITY
    ): JsonResponse {
        return response()->json([
            'status'     => ResponseStatus::FAILED,
            'statusCode' => ResponseStatusCode::VALIDATION,
            'data'       => $data,
            'message'    => $messages,
        ], $responseCode);
    }

    public function success($data = [], $message = null, $responseCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status'     => ResponseStatus::SUCCESS,
            'statusCode' => ResponseStatusCode::SUCCESS,
            'data'       => $data,
            'message'    => $message,
        ], $responseCode);
    }

    public function error($message = null, $data = [], $responseCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'status'     => ResponseStatus::FAILED,
            'statusCode' => ResponseStatusCode::FAILED,
            'data'       => $data,
            'message'    => $message,
        ], $responseCode);
    }

    public function exception($message = null, $data = [], $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json([
            'status'     => ResponseStatus::FAILED,
            'statusCode' => ResponseStatusCode::EXCEPTION,
            'data'       => $data,
            'message'    => $message,
        ], $responseCode);
    }


}
