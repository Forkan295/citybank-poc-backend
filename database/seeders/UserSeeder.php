<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::insert([
            [
                'name' => 'Admin',
                'uuid' => Str::uuid(),
                'email' => 'admin@mail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'User',
                'uuid' => Str::uuid(),
                'email' => 'user@mail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Client',
                'uuid' => Str::uuid(),
                'email' => 'client@mail.com',
                'password' => bcrypt('123456'),
            ]
        ]);
    }
}
