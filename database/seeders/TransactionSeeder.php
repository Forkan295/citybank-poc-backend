<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = [
            [
                'account_id' => 1,
                'user_id' => 1,
                'type_id' => 1,
                'amount' => 100,
                'description' => 'Deposit',
            ],
            [
                'account_id' => 1,
                'user_id' => 1,
                'type_id' => 2,
                'amount' => 100,
                'description' => 'Deposit',
            ],
            [
                'account_id' => 1,
                'user_id' => 1,
                'type_id' => 3,
                'amount' => 100,
                'description' => 'Deposit',
            ],
            [
                'account_id' => 4,
                'user_id' => 2,
                'type_id' => 1,
                'amount' => 100,
                'description' => 'Deposit',
            ],
            [
                'account_id' => 3,
                'user_id' => 2,
                'type_id' =>2,
                'amount' => 100,
                'description' => 'Deposit',
            ],
            [
                'account_id' => 6,
                'user_id' => 3,
                'type_id' =>2,
                'amount' => 100,
                'description' => 'Deposit',
            ],
        ];

        foreach ($transactions as $transaction) {
            \App\Models\Transaction::create($transaction);
        }
    }
}
