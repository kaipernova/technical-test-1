<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Property;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_properties()
    {
        $properties = Property::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/property');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'properties' => [
                        '*' => [
                            'id',
                            'organisation',
                            'property_type',
                            'uprn',
                            'address',
                            'town',
                            'postcode',
                            'live'
                        ]
                    ],
                    'pagination' => [
                        'total',
                        'per_page',
                        'current_page',
                        'last_page',
                        'from',
                        'to'
                    ]
                ]
            ]);
    }

    public function test_can_get_single_property()
    {
        $property = Property::factory()->create();

        $response = $this->getJson('/api/v1/property/' . $property->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'organisation',
                    'property_type',
                    'uprn',
                    'address',
                    'town',
                    'postcode',
                    'live'
                ]
            ]);
    }

    public function test_can_create_property()
    {
        $property = Property::factory()->create();

        $response = $this->postJson('/api/v1/property', $property->toArray());

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'organisation',
                    'property_type',
                    'uprn',
                    'address',
                    'town',
                    'postcode',
                    'live'
                ]
            ]);
    }

    public function test_can_update_property()
    {
        $property = Property::factory()->create();

        $propertyData = [
            'organisation' => 'Updated Test'
        ];

        $response = $this->patchJson('/api/v1/property/' . $property->id, $propertyData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('properties', ['id' => $property->id, 'organisation' => 'Updated Test']);
    }

    public function test_can_delete_property()
    {
        $property = Property::factory()->create();

        $response = $this->deleteJson('/api/v1/property/' . $property->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('properties', ['id' => $property->id]);
    }
}
