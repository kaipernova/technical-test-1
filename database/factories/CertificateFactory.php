<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificate>
 */
class CertificateFactory extends Factory
{
    protected $model = Certificate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stream_name' => fake()->randomElement(['Gas', 'FRA', 'WRA']),
            'property_id' => Property::factory()->create()->id,
            'issue_date' => fake()->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d'),
            'next_due_date' => fake()->dateTimeBetween('+1 year', '+2 years')->format('Y-m-d'),
        ];
    }
}
