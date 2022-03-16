<?php

namespace App\Http\Controllers\Api;

use App\Enums\MessageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\BeneficiaryRequest;
use App\Http\Resources\BeneficiaryResource;
use App\Http\Response\ApiResponse;
use App\Models\Beneficiary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class BeneficiaryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $user          = auth('api')->user();
            $beneficiaries = data_get($user, 'beneficiaries', '');
            return app(ApiResponse::class)->success(['items' => BeneficiaryResource::collection($beneficiaries)]);
        } catch (\Exception $e) {
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BeneficiaryRequest $request
     * @return JsonResponse
     */
    public function store(BeneficiaryRequest $request): JsonResponse
    {
        try {
            $user = auth('api')->user();
            $user->beneficiaries()->create($request->all());
            return app(ApiResponse::class)->success('', MessageEnum::SUCCESS);
        } catch (\Exception $exception) {
            return app(ApiResponse::class)->error($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BeneficiaryRequest $request
     * @param Beneficiary $beneficiary
     * @return JsonResponse
     */
    public function update(BeneficiaryRequest $request, Beneficiary $beneficiary): JsonResponse
    {
        try {
            $beneficiary->update($request->all());
            return app(ApiResponse::class)->success('', MessageEnum::UPDATE);
        } catch (\Throwable $exception) {
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }


    /**
     * @param Beneficiary $beneficiary
     * @return JsonResponse
     */
    public function destroy(Beneficiary $beneficiary): JsonResponse
    {
        try {
            $beneficiary->delete();
            return app(ApiResponse::class)->success([], 'Data Deleted successfully');
        } catch (\Exception $exception) {
            return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
        }
    }
}
