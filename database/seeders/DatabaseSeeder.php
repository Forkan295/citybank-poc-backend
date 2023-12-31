<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(AccountTypeSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(TransactionTypeSeeder::class);
        $this->call(MobileOperatorListSeeder::class);
        $this->call(BankListSeeder::class);
//        $this->call(TransactionSeeder::class);
//        $this->call(BeneficiarySeeder::class);
    }
}
