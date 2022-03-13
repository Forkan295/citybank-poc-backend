<?php


namespace App\Service;


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
            'user'     => [
                'name'    => data_get($user, 'name', ''),
                'email'   => data_get($user, 'email', ''),
                'phone'   => data_get($user, 'phone', ''),
                'address' => data_get($user, 'address', ''),
            ],
            'accounts' => $user->accounts->map(function ($item) {
                return [
                    'account_no'   => data_get($item, 'account_no', ''),
                    'account_type' => data_get($item, 'accountType.name', ''),
                    'opening_date' => data_get($item, 'date_opened', ''),
                    'balance'      => number_format(data_get($item, 'balance', 0), 2, '.', ''),
                ];
            }),
        ];
    }

}
