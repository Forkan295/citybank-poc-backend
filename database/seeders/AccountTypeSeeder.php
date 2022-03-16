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
            'Savings',
            'Current',
            'Salary',
            'Credit Card',
            'Recurring Deposit',
            'Fixed Deposit',
        ];

        foreach ($accountTypes as $accountType) {
            \App\Models\AccountType::create([
                'name' => $accountType,
            ]);
        }
    }
}
