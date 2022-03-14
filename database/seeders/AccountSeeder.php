<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $accounts = [
            [
                'account_no' => '123456789',
                'user_id' => 1,
                'type_id' => 1,
                'date_opened' => '2020-03-08',
                'balance' => 0,
            ],
            [
                'account_no' => '987654321',
                'user_id' => 1,
                'type_id' => 2,
                'date_opened' => '2020-03-08',
                'balance' => 1000,
                'is_primary_account' => 1,
            ],
            [
                'account_no' => '987654322',
                'user_id' => 2,
                'type_id' => 3,
                'date_opened' => '2020-03-08',
                'balance' => 800,
                'is_primary_account' => 1,
            ],
            [
                'account_no' => '987654323',
                'user_id' => 3,
                'type_id' => 4,
                'date_opened' => '2020-03-08',
                'balance' => 0,
            ],
            [
                'account_no' => '987654324',
                'user_id' => 3,
                'type_id' => 5,
                'date_opened' => '2020-03-08',
                'balance' => 0,
            ],
            [
                'account_no' => '987654325',
                'user_id' => 2,
                'type_id' => 6,
                'date_opened' => '2020-03-08',
                'balance' => 0,
            ],
        ];

        foreach ($accounts as $account) {
            \App\Models\Account::create($account);
        }
    }
}
