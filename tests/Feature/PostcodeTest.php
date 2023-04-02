<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\Postcode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostcodeTest extends TestCase
{
    use DatabaseTransactions;
    public function setUp(): void
    {
        parent::setUp();
        Postcode::factory()->count(10)->create();
    }

    public function test_get_all_postcodes_with_filter()
    {
        $response = $this->get('/api/v1/postcode/get-all-postcodes?usertype=1');
        $response->assertStatus(200);
        $jsonResponse = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('postcodes', $jsonResponse);
        $this->assertNotEmpty($jsonResponse['postcodes']);
    }

    public function test_returns_nearby_postcodes()
    {
        $lat = 10.5074;
        $long = -2.1278;
        $response = $this->get('/api/v1/postcode/get-nearby-postcodes?usertype=1&lat=' . $lat . '&long=' . $long . '&distance=100');
        $response->assertStatus(200);
        $jsonResponse = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('postcodes', $jsonResponse);
        $this->assertNotEmpty($jsonResponse['postcodes']);
    }
}
