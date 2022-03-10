<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $users = 10;

       for($i = 0; $i < $users; $i++) {
            \App\Models\User::factory(1)->create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@admin.com',
                'password' => bcrypt('password'),
            ]);
       }
    }
}
