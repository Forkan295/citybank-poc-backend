<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $types  = [
            'deposit',
            'withdraw',
            'bank-transfer',
            'other-transfer',
            'recharge',
        ];

        foreach ($types as $type) {
            \App\Models\TransactionType::create([
                'name' => $type,
            ]);
        }
    }
}
