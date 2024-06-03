<?php

namespace Database\Factories;

use App\Models\House;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'house_id' => House::inRandomOrder()->value('id'),
            'contact_number' => fake()->numberBetween(1),
            'email' => fake()->email(),
            'start_date'=> fake()->date(),
            'balance' => fake()->randomNumber(3),
        ];
    }
}
