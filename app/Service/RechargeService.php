<?php


namespace App\Service;


use App\Models\MobileOperator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RechargeService
{
    public function prepareTransactionData(Request $request, $primaryAccount): array
    {
        return [
            'account_id'       => data_get($primaryAccount, 'id'),
            'type_id'          => data_get($request, 'transfer_type'),
            'transfer_amount'  => data_get($request, 'amount'),
            'remarks'          => data_get($request, 'remarks', ''),
            'previous_amount'  => data_get($primaryAccount, 'balance'),
            'transaction_date' => Carbon::now()->toDateTime(),
            'status'           => 'success',
        ];
    }

    public function prepareRechargeData(Request $request): array
    {
        $operator = MobileOperator::where('name', $request->operator_name)->first();
        return [
            'operator_id'     => data_get($operator, 'id'),
            'phone_number'    => data_get($request, 'phone_number'),
            'recharge_amount' => data_get($request, 'recharge_amount'),
        ];
    }
}
