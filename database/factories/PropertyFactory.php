<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organisation' => fake()->company(),
            'property_type' => fake()->randomElement(['Resident', 'Block']),
            'uprn' => fake()->uuid(),
            'address' => fake()->address(),
            'town' => fake()->city(),
            'postcode' => fake()->postcode(),
            'live' => fake()->boolean()
        ];
    }
}
