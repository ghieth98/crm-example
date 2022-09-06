<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'client_name' => fake()->name(),
            'client_email' => fake()->safeEmail(),
            'client_phone' => fake()->phoneNumber(),
            'company_name' => fake()->company(),
            'company_address' => fake()->address(),
            'company_city' => fake()->city(),
            'company_zip' => fake()->randomNumber(5),
            'company_vat' => fake()->randomNumber(),
        ];
    }
}
