<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class PhotosApiTest extends TestCase
{
    use WithFaker;

    private $user;

    /**
     * Setup actions
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::first();
    }

    /**
     * Test uploaded photo
     *
     * @return void
     */
    public function testPostPhoto()
    {
        $request = [
            'file' => UploadedFile::fake()->image('image.jpg', 500,500), // Create fake image file
            'reference' => $this->faker->text(rand(10, 30)),
            'description' => $this->faker->text(rand(50, 200)),
        ];

        $response = $this->actingAs($this->user, 'api')
            ->post('/api/photo', $request);

//        dd($response->original);

        $response->assertJsonStructure([
            'id',
            'path',
            'filename',
            'reference',
            'description'
        ]);

        // Assert the file was stored...
        Storage::disk('public')
            ->assertExists($response->original->path . '/' . $response->original->filename);

        Storage::disk('public')
            ->assertExists($response->original->path . '/150x_' . $response->original->filename);

        Storage::disk('public')
            ->assertExists($response->original->path . '/500x_' . $response->original->filename);
    }
}
