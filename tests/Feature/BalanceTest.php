<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BalanceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetBalance()
    {
        $this->json('GET', 'api/balances/2', [], ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
