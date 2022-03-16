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
                'account_no'   => '123456789',
                'user_id'      => 1,
                'type_id'      => 1,
                'opening_date' => '2020-03-08',
                'balance'      => 200000,
                'is_primary'   => 1,
            ],
            [
                'account_no'   => '987654321',
                'user_id'      => 1,
                'type_id'      => 2,
                'opening_date' => '2020-03-08',
                'balance'      => 40000,
                'is_primary'   => 0,
            ],
            [
                'account_no'   => '987654322',
                'user_id'      => 2,
                'type_id'      => 3,
                'opening_date' => '2020-03-08',
                'balance'      => 800,
                'is_primary'   => 0,
            ],
        ];

        foreach ($accounts as $account) {
            \App\Models\Account::create($account);
        }
    }
}
