<?php


namespace App\Service;


use Carbon\Carbon;
use FG\ASN1\Universal\Boolean;
use Illuminate\Http\Request;

class AuthService
{


    public function basicRules(): array
    {
        return [
            'email'    => 'required|email:rfc,dns',
            'password' => 'required'
        ];
    }


    public function matchCredentials(Request $request): bool
    {
        $loginData = $request->only('email', 'password');
        return auth()->attempt($loginData);
    }


    public function getUserData($user): array
    {
        return [
            'name'    => data_get($user, 'name', ''),
            'email'   => data_get($user, 'email', ''),
            'phone'   => data_get($user, 'phone', ''),
            'address' => data_get($user, 'address', ''),
        ];
    }


    public function getUserAccounts($user): array
    {
        $content = [];
        if (!blank($user->accounts)) {
            $content = $user->accounts->map(function ($item) {
                return [
                    'account_no'   => data_get($item, 'account_no', ''),
                    'account_type' => data_get($item, 'accountType.name', ''),
                    'opening_date' => data_get($item, 'date_opened', ''),
                    'balance'      => number_format(data_get($item, 'balance', 0), 2, '.', ''),
                    'is_primary'   => data_get($item, 'is_primary')
                ];
            });
        }
        return $content;
    }


    public function prepareTransactionData(Request $request, $primaryAccount): array
    {
        return [
            'account_id'       => data_get($primaryAccount, 'id'),
            'type_id'          => data_get($request, 'transfer_type'),
            'beneficiary_id'   => data_get($request, 'beneficiary'),
            'transfer_amount'  => data_get($request, 'amount'),
            'remarks'          => data_get($request, 'remarks', ''),
            'previous_amount'  => data_get($primaryAccount, 'balance'),
            'transaction_date' => Carbon::now()->toDateTime(),
            'status'           => 'success',
        ];
    }


    public function getAccountTransaction($user)
    {
        $content = [];
        if (!blank($user->transactions)) {
            $transactions = $user->transactions->where('status', 'success');
            $content      = $transactions->map(function ($item) {
                return [
                    'invoice_id'       => data_get($item, 'invoice_id', ''),
                    'transaction_type' => data_get($item, 'transactionType.name', ''),
                    'beneficiary'      => [
                        'account_name' => data_get($item, 'beneficiary.account_name', ''),
                        'account_no'   => data_get($item, 'beneficiary.account_no', ''),
                        'bank_name'    => data_get($item, 'beneficiary.bank_name', ''),
                        'branch_name'  => data_get($item, 'beneficiary.branch_name', ''),
                        'branch_city'  => data_get($item, 'beneficiary.branch_city', ''),
                    ],
                    'previous_amount'  => data_get($item, 'previous_amount', ''),
                    'transfer_amount'  => data_get($item, 'transfer_amount', ''),
                    'remarks'          => data_get($item, 'remarks'),
                    'transaction_date' => data_get($item, 'transaction_date')->format('d-m-Y, h:i'),
                    'status'           => data_get($item, 'status'),
                ];
            });
        }


        return $content;
    }


}
