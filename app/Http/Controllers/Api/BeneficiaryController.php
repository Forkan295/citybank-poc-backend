<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseStatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\BeneficiaryRequest;
use App\Http\Resources\BeneficiaryResource;
use App\Http\Response\ApiResponse;
use App\Models\Beneficiary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BeneficiaryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $beneficiaries = Beneficiary::whereStatus(1)->get();
        return app(ApiResponse::class)->success(BeneficiaryResource::collection($beneficiaries), 'Success');
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
            $request->merge(['user_id' => $user->id]);
            $beneficiary = Beneficiary::create($request->all());
            return app(ApiResponse::class)->success(new BeneficiaryResource($beneficiary), 'Beneficiary created successfully');
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
            return app(ApiResponse::class)->success(new BeneficiaryResource($beneficiary), 'Beneficiary updated successfully');
        } catch (\Throwable $exception) {
            return response()->json(['response' => app(ApiResponse::class)->error($exception->getMessage())]);
        }
    }


    /**
     * @param Beneficiary $beneficiary
     * @return JsonResponse
     */
    public function destroy(Beneficiary $beneficiary): JsonResponse
    {
        DB::beginTransaction();
        try {
            $beneficiary->delete();
            DB::commit();
            return app(ApiResponse::class)->success([], 'Beneficiary Deleted successfully');
        } catch (\Exception $exception) {
            DB::rollback();
            return app(ApiResponse::class)->error($exception->getMessage());
        }
    }
}
