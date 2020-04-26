<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideosApiTest extends TestCase
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
     * Test post a video
     *
     * @return void
     */
    public function testPostVideo() : void
    {
        $request = [
            'name' => $this->faker->text(rand(15, 30)),
            'url' => "https://www.youtube.com/watch?v=ibgkLzQVgjo"
        ];

        $response = $this->actingAs(static::$user, 'api')
            ->post('/api/video', $request);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'url',
                'created_at',
                'updated_at'
            ]);
    }
}
