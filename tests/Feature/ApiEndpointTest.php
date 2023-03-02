<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiEndpointTest extends TestCase
{

    public function testEndpoint(): void
    {
        $response = $this->get('/api/grouped_activities');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'type',
                'max_price',
                'avg_price',
                'total_participants'
            ]
        ]);
    }
}
