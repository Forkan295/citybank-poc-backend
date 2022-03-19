<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'OAuth2 Admin',
                'uuid' => Str::uuid(),
                'email' => 'oauth2@admin.com',
                'password' => bcrypt('swt@123'),
                'role' => 'oauth',
            ],
            [
                'name' => 'API Admin',
                'uuid' => Str::uuid(),
                'email' => 'api@admin.com',
                'password' => bcrypt('swt@123'),
                'role' => 'api',
            ],
            [
                'name' => 'Client',
                'uuid' => Str::uuid(),
                'email' => 'client@admin.com',
                'password' => bcrypt('swt@123'),
                'role' => 'client',
            ],
        ];

        foreach ($data as $item) {
            User::create($item);
        }
    }
}
