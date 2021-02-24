<?php

namespace Tests\Feature;

use App\Models\Beer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BeerClientTest extends TestCase
{
    use RefreshDatabase;

    private $baseUrl = '/api/beers';

    /**
     * @return void
     */
    public function test_index_is_success()
    {
        Beer::factory()->count(3)->create();

        $response = $this->getJson($this->baseUrl);

        $response
            ->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    /**
     * @return void
     */
    public function test_show_is_success()
    {
        $beer = Beer::factory()->create();

        $response = $this->getJson($this->baseUrl . '/' . $beer->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_show_is_fail()
    {
        $response = $this->getJson($this->baseUrl . '/99999');

        $response->assertNotFound();
    }
}
