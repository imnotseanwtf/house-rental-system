<?php

namespace Database\Factories;

use App\Models\HouseType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'house_number' => fake()->randomNumber(3),
            'house_type_id' => HouseType::inRandomOrder()->value('id'),
            'description' => fake()->sentence(),
            'price' => fake()->randomNumber(3),
        ];
    }
}
