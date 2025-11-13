<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Note;
use App\Models\Property;
use App\Models\Certificate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_property_notes()
    {
        $property = Property::factory()->create();

        $response = $this->getJson('/api/v1/property/' . $property->id . '/note');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'notes' => [
                        '*' => [
                            'id',
                            'note',
                            'user_id',
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

    public function test_can_create_property_note()
    {
        $property = Property::factory()->create();
        $note = Note::factory()->create([
            'notable_id' => $property->id,
            'notable_type' => Property::class
        ]);

        $response = $this->postJson('/api/v1/property/' . $property->id . '/note', $note->toArray());

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'note',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function test_can_get_certificate_notes()
    {
        $certificate = Certificate::factory()->create();
        $notes = Note::factory()->count(3)->create([
            'notable_id' => $certificate->id,
            'notable_type' => Certificate::class
        ]);

        $response = $this->getJson('/api/v1/certificate/' . $certificate->id . '/note');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'notes' => [
                        '*' => [
                            'id',
                            'note',
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

    public function test_can_create_certificate_note()
    {
        $certificate = Certificate::factory()->create();
        $note = Note::factory()->create([
            'notable_id' => $certificate->id,
            'notable_type' => Certificate::class
        ]);

        $response = $this->postJson('/api/v1/certificate/' . $certificate->id . '/note', $note->toArray());

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'note',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }
}
