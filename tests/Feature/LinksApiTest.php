<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LinksApiTest extends TestCase
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
     * Test post a link
     *
     * @return void
     */
    public function testPostLink() : void
    {
        $request = [
            'name' => $this->faker->text(rand(15, 30)),
            'url' => "https://error.gr"
        ];

        $response = $this->actingAs(static::$user, 'api')
            ->post('/api/link', $request);

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
