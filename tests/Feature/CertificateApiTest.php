<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Note;
use App\Models\Property;
use App\Models\Certificate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CertificateApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_can_get_all_certificates()
    {
        $response = $this->getJson('/api/v1/certificate');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'certificates' => [
                        '*' => [
                            'id',
                            'stream_name',
                            'property_id',
                            'issue_date',
                            'next_due_date',
                            'created_at',
                            'updated_at'
                        ]
                    ]
                ]
            ]);
    }

    public function test_can_get_single_certificate()
    {
        $certificate = Certificate::factory()->create();

        $response = $this->getJson('/api/v1/certificate/' . $certificate->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'stream_name',
                    'property_id',
                    'issue_date',
                    'next_due_date',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function test_can_create_certificate()
    {
        $property = Property::factory()->create();
        $certificate = Certificate::factory()->create([
            'property_id' => $property->id
        ]);

        $response = $this->postJson('/api/v1/certificate', $certificate->toArray());

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'stream_name',
                    'property_id',
                    'issue_date',
                    'next_due_date',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function test_can_get_property_certificates()
    {
        $property = Property::factory()->create();
        $certificates = Certificate::factory()->count(3)->create([
            'property_id' => $property->id
        ]);

        $response = $this->getJson('/api/v1/property/' . $property->id . '/certificate');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'certificates' => [
                        '*' => [
                            'id',
                            'stream_name',
                            'property_id',
                            'issue_date',
                            'next_due_date',
                            'created_at',
                            'updated_at'
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
}
