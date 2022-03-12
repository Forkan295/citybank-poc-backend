<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BeneficiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $beneficiaries = [
            [
                'account_no' => '1234567890',
                'user_id' => 1,
                'name' => 'John Doe',
                'bank_name' => 'Bank of America',
                'branch_name' => 'Branch of Bank of America',
                'branch_city' => 'New Yourk',
                'currency'    => 'bdt',
                'routing_number' => '1234567789',
            ],
            [
                'account_no' => '1234567850',
                'user_id' => 1,
                'name' => 'Jane Doe',
                'bank_name' => 'Bank of America',
                'branch_name' => 'Branch of Bank of America',
                'branch_city' => 'New Yourk',
                'currency'    => 'bdt',
                'routing_number' => '1234356789',
            ],
            [
                'account_no' => '1234567840',
                'user_id' => 2,
                'name' => 'John Doe',
                'bank_name' => 'Bank of America',
                'branch_name' => 'Branch of Bank of America',
                'branch_city' => 'New Yourk',
                'currency'    => 'bdt',
                'routing_number' => '1234566789',
            ],
            [
                'account_no' => '1234567850',
                'user_id' => 2,
                'name' => 'Jane Doe',
                'bank_name' => 'Bank of America',
                'branch_name' => 'Branch of Bank of America',
                'branch_city' => 'New Yourk',
                'currency'    => 'bdt',
                'routing_number' => '1234556789',
            ],
            [
                'account_id' => 1,
                'account_no' => '1234577890',
                'user_id' => 3,
                'name' => 'John Doe',
                'bank_name' => 'Bank of America',
                'branch_name' => 'Branch of Bank of America',
                'branch_city' => 'New Yourk',
                'currency'    => 'bdt',
                'routing_number' => '1234456789',
            ],
            [
                'account_id' => 1,
                'account_no' => '1234567880',
                'user_id' => 3,
                'name' => 'Jane Doe',
                'bank_name' => 'Bank of America',
                'branch_name' => 'Branch of Bank of America',
                'branch_city' => 'New Yourk',
                'currency'    => 'bdt',
                'routing_number' => '12334556789',
            ]
            ];

        foreach ($beneficiaries as $beneficiary) {
            \App\Models\Beneficiary::create($beneficiary);
        }

    }
}
