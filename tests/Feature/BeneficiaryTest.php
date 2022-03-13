<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BeneficiaryTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->initDatabase();
    }

    public function tearDown(): void
    {
        $this->resetDatabase();
        parent::tearDown();
    }

    /** @test */
    public function can_create_beneficiary()
    {
        $this->post(route('beneficiary.create'), [
            'account_no'     => '123456789',
            'name'           => 'John Doe',
            'routing_number' => '123456789',
            'bank_name'      => 'Bank of America',
            'branch_name'    => 'Bank of America',
            'branch_city'    => 'Bank of America',
            'currency'       => 'USD',
        ])->assertStatus(201);

    }
}
