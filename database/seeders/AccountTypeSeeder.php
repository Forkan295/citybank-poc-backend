<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accountTypes = [
            'Checking',
            'Savings',
            'Credit Card',
            'Investment',
            'Mortgage',
            'Other',
        ];

        foreach ($accountTypes as $accountType) {
            \App\Models\AccountType::create([
                'name' => $accountType,
            ]);
        }
    }
}
