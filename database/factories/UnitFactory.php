<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::factory(),
            'unit_number' => fake()->unique()->numberBetween(100, 999),
            'bedrooms' => fake()->numberBetween(0, 4),
            'bathrooms' => fake()->randomElement([1, 1.5, 2, 2.5, 3]),
            'square_feet' => fake()->numberBetween(450, 2000),
            'rent' => fake()->numberBetween(900, 4500),
            'status' => fake()->randomElement(['available', 'leased', 'unavailable']),
            'available_on' => fake()->optional()->dateTimeBetween('now', '+3 months'),
            'description' => fake()->optional()->sentence(),
        ];
    }
}
