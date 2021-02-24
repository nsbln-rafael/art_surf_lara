<?php

namespace Tests\Feature;

use App\Models\Beer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BeerAdminTest extends TestCase
{
    use RefreshDatabase;

    private $baseUrl = '/api/admin/beers';

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
    public function test_store_is_success()
    {
        $beer = [
            'title'       => 'test title',
            'description' => 'test description',
            'photo'       => $this->getFakeImage(),
        ];

        $response = $this->postJson($this->baseUrl, $beer);

        $response->assertStatus(201);
    }

    /**
     * @return void
     */
    public function test_store_is_fail_without_file()
    {
        $beer = [
            'title'       => 'test title',
            'description' => 'test description',
        ];

        $response = $this->postJson($this->baseUrl, $beer);

        $response->assertJsonValidationErrors(["photo" => "The photo field is required."]);
    }

    /**
     * @return void
     */
    public function test_store_is_fail_without_title_and_file()
    {
        $beer = [
            'description' => 'test description',
        ];

        $response = $this->postJson($this->baseUrl, $beer);

        $response->assertJsonValidationErrors([
            "title" => "The title field is required.",
            "photo" => "The photo field is required."
        ]);
    }

    /**
     * @return void
     */
    public function test_update_is_success()
    {
        $beer = [
            'title'       => 'test title',
            'description' => 'test description',
            'photo'       => $this->getFakeImage(),
        ];

        $response = $this->postJson($this->baseUrl, $beer);
        $id       = $response->getData()->data->id;

        $beerPatch = [
            'title'       => 'test title new',
            'description' => 'test description new',
        ];

        $response = $this->patchJson($this->baseUrl . '/' . $id, $beerPatch);

        $response->assertJsonFragment($beerPatch);
    }

    /**
     * @return void
     */
    public function test_update_is_fail_on_unique()
    {
        $beer = [
            'title'       => 'test title',
            'description' => 'test description',
            'photo'       => $this->getFakeImage(),
        ];

        $response = $this->postJson($this->baseUrl, $beer);
        $id       = $response->getData()->data->id;

        $beerPatch = [
            'title' => 'test title',
        ];

        $response = $this->patchJson($this->baseUrl . '/' . $id, $beerPatch);

        $response->assertJsonValidationErrors([
            "title" => "The title has already been taken.",
        ]);
    }

    /**
     * @return void
     */
    public function test_delete_is_success()
    {
        $beer = [
            'title'       => 'test title',
            'description' => 'test description',
            'photo'       => $this->getFakeImage(),
        ];

        $response = $this->postJson($this->baseUrl, $beer);
        $id       = $response->getData()->data->id;

        $response = $this->deleteJson($this->baseUrl . '/' . $id);

        $response->assertStatus(204);
    }

    /**
     * @return File
     */
    private function getFakeImage(): File
    {
        Storage::fake('images');

        return UploadedFile::fake()->image('test.jpg', 600, 600);
    }
}
