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
            'Ac to AC',
            'Other bank',
            'Recharge',
        ];

        foreach ($types as $type) {
            \App\Models\TransactionType::create([
                'name' => $type,
            ]);
        }
    }
}
