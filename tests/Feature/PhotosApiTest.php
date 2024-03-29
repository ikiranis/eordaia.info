<?php

namespace Tests\Feature;

use App\Photo;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class PhotosApiTest extends TestCase
{
    use WithFaker;

    protected static $user;
    protected static bool $setUpRun = false;

    /**
     * Setup actions
     */
    public function setUp() : void
    {
        parent::setUp();

        if (!static::$setUpRun) {
            static::$user = User::first();

            static::$setUpRun = true;
        }
    }

    /**
     * Test uploaded photo
     *
     * @return void
     */
    public function testPostPhoto() : void
    {
        $request = [
            'file' => UploadedFile::fake()
                ->image('image.jpg', 2000,2000), // Create fake image file
            'description' => $this->faker->text(rand(50, 200)),
            'referral' => 'https://apps4net.eu',
        ];

        $response = $this->actingAs(static::$user, 'api')
            ->post('/api/photo', $request);

//        dd($response->original);

        $response->assertJsonStructure([
            'id',
            'path',
            'filename',
            'description',
            'referral',
            'photoUrl',
            'smallPhotoUrl',
            'mediumPhotoUrl',
            'photoUploaded',
            'viewable',
            'largePhotoUrl',
            'label',
            'preloadUrl',
            'ratio'
        ]);

        // Assert the file was stored...
        Storage::disk('public')
            ->assertExists($response->original->path . '/' . $response->original->filename);

        Storage::disk('public')
            ->assertExists($response->original->path . '/'. config('app.SMALL_IMAGE') . 'x_' . $response->original->filename);

        Storage::disk('public')
            ->assertExists($response->original->path . '/' . config('app.MEDIUM_IMAGE') . 'x_' . $response->original->filename);

        Storage::disk('public')
            ->assertExists($response->original->path . '/' . config('app.LARGE_IMAGE') . 'x_' . $response->original->filename);

        Storage::disk('public')
            ->assertExists($response->original->path . '/' . config('app.PRELOAD_IMAGE') . 'x_' . $response->original->filename);
    }

    /**
     * Test the list of photos
     */
    public function testGetListPhotos() : void
    {
        $response = $this->actingAs(static::$user, 'api')
            ->get('/api/photos');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'path',
                'filename',
                'description',
                'referral',
                'photoUrl',
                'smallPhotoUrl',
                'mediumPhotoUrl',
                'photoUploaded',
                'viewable',
                'largePhotoUrl',
                'label',
                'preloadUrl',
                'ratio'
            ]
        ]);
    }

    /**
     * Test get photo Api
     */
    public function testGetPhoto() : void
    {
        $photo = Photo::first();

        $response = $this->actingAs(static::$user, 'api')
            ->get('/api/photo/' . $photo->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
                'id',
                'path',
                'filename',
                'description',
                'referral',
                'photoUrl',
                'smallPhotoUrl',
                'mediumPhotoUrl',
                'photoUploaded',
                'viewable',
                'largePhotoUrl',
                'preloadUrl',
                'ratio'
        ]);
    }
}
