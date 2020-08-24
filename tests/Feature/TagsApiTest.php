<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagsApiTest extends TestCase
{
    use WithFaker;

    protected static $user;
    protected static string $tagName;
    protected static bool $setUpRun = false;

    /**
     * Setup actions
     */
    public function setUp() : void
    {
        parent::setUp();

        if (!static::$setUpRun) {
            static::$user = User::first();
            static::$tagName = $this->faker->text(rand(10, 15));

            static::$setUpRun = true;
        }
    }

    /**
     * Test post a tag
     *
     * @return void
     */
    public function testPostTag() : void
    {
        $request = [
            'name' => static::$tagName
        ];

        $response = $this->actingAs(static::$user, 'api')
            ->post('/api/tag', $request);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'id',
            'name'
        ]);
    }

    /**
     * Test tags list api
     */
    public function testListTags() : void
    {
        $response = $this->actingAs(static::$user, 'api')
            ->get('/api/tags');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'name'
            ]
        ]);
    }
}
