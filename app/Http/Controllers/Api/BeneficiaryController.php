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
     * Store a newly created resource in storage.
     *
     * @param BeneficiaryRequest $request
     * @return JsonResponse
     */
    public function store(BeneficiaryRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $user = auth('api')->user();
            $request->merge(['user_id' => $user->id]);
            $beneficiary = Beneficiary::create($request->all());
            DB::commit();
            return response()->json(['response' => ApiResponse::success(new BeneficiaryResource($beneficiary), 'Beneficiary created successfully')], Response::HTTP_OK);
        } catch (\Exception $exception) {
            DB::rollback();
            return ApiResponse::error(ResponseStatusCode::FAILED, $exception->getMessage());
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
        DB::beginTransaction();
        try {
            $beneficiary->update($request->all());
            DB::commit();
            return response()->json(['response' => ApiResponse::success(new BeneficiaryResource($beneficiary), 'Beneficiary Updated successfully')], Response::HTTP_OK);
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['response' => ApiResponse::error(null, $exception->getMessage())], Response::HTTP_INTERNAL_SERVER_ERROR);
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
            return response()->json(['response' => ApiResponse::success([], 'Beneficiary Deleted successfully')], Response::HTTP_OK);
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json(['response' => ApiResponse::error(null, $exception->getMessage())], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
