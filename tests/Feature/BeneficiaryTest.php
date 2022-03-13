<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BeneficiaryTest extends TestCase
{
    use RefreshDatabase;
    public $token;

    /**
     * @test
     */
    public function testOauthLogin() {
        DB::table('oauth_clients')->insert([
            'id' => '95c88f11-c866-4cc1-b83e-70979662e0e4',
            'secret' => 'KlSaihLOqjKHyAjRSLOu8HJqA1mxWV7zQ6rsUxnc',
            'name' => 'users',
            'redirect' => 'http://localhost',
            'personal_access_client' => '1',
            'password_client' => '0',
            'revoked' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user = User::create([
            'name' => 'test',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('password'),

        ]);

        $body = [
            'email' => $user->email,
            'password' => 'password'
        ];
        $user = $this->json('POST','http://oauth2-poc.test:8080/v1/login',$body,['Accept' => 'application/json']);
        $this->token = $user['data']['access_token'];
        $user->assertStatus(200);

    }

    /** @test */
    public function can_create_beneficiary()
    {
        $this->testOauthLogin();

        $this->json('POST', route('beneficiary.create'), [
            'account_no'     => '123456789',
            'name'           => 'John Doe',
            'routing_number' => '123456789',
            'bank_name'      => 'Bank of America',
            'branch_name'    => 'Bank of America',
            'branch_city'    => 'Bank of America',
            'currency'       => 'USD',
        ], ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$this->token])->assertStatus(200);

    }
}
