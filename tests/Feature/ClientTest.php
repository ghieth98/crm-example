<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_client_can_be_added()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/client', [

            'client_name' => fake()->name() ,
            'client_email' => fake()->safeEmail(),
            'client_phone' => fake()->phoneNumber(),
            'company_name' => fake()->company(),
            'company_address' => fake()->address(),
            'company_city' => fake()->city(),
            'company_zip' => fake()->companySuffix(),
            'company_vat' => fake()->numberBetween(0,100),
        ]);

        $response->assertOk();
        $this->assertCount(1, Client::all());

    }







}
