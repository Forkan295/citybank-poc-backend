<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BeneficiaryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->initDatabase();
    }

    /**
     * @test
     */
    public function tearDown(): void
    {
        $this->resetDatabase();
        parent::tearDown();
    }

    /**
     * @test
     */
    public function testOauthLogin() {
        $user = User::create([
            'name' => 'test',
            'email' => 'user1@gmail.com',
            'password' => 'password'

        ]);
        $body = [
            'email' => $user->email,
            'password' => 'password'
        ];
        $user = $this->json('POST','http://oauth2-poc.test:8080/v1/login',$body,['Accept' => 'application/json']);
        $user->assertStatus(200);
    }

//    /** @test */
//    public function can_create_beneficiary()
//    {
//        $this->post(route('beneficiary.create'), [
//            'account_no'     => '123456789',
//            'name'           => 'John Doe',
//            'routing_number' => '123456789',
//            'bank_name'      => 'Bank of America',
//            'branch_name'    => 'Bank of America',
//            'branch_city'    => 'Bank of America',
//            'currency'       => 'USD',
//        ])->assertStatus(201);
//
//    }
}
