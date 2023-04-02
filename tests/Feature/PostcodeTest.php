<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\Postcode;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostcodeTest extends TestCase
{
    use  RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        Postcode::factory()->count(10)->create();
    }

    public function test_get_all_postcodes_with_filter()
    {
        $query = '';
        $response = $this->get('/api/v1/postcode/get-all-postcodes?usertype=1&q='.$query);
        
        $response->assertStatus(200);
        $jsonResponse = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('status', $jsonResponse);
        $this->assertArrayHasKey('data', $jsonResponse);
        $this->assertArrayHasKey('message', $jsonResponse);
        $this->assertNotEmpty($jsonResponse['data']);
    }

    public function test_returns_nearby_postcodes()
    {
        $lat = 10.5074;
        $long = -1.1278;
        $response = $this->get('/api/v1/postcode/get-nearby-postcodes?usertype=1&lat=' . $lat . '&long=' . $long . '&distance=10');
        $jsonResponse = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('status', $jsonResponse);
        $this->assertArrayHasKey('data', $jsonResponse);
        $this->assertArrayHasKey('message', $jsonResponse);
    }
}
