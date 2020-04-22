<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagsApiTest extends TestCase
{
    use WithFaker;

    protected static Authenticatable $user;
    protected static string $tagName;
    protected static bool $setUpRun = false;

    /**
     * Setup actions
     */
    public function setUp() : void
    {
        parent::setUp();

        if (!static::$setUpRun) {
            $this::$user = User::first();
            $this::$tagName = $this->faker->text(rand(10, 15));

            $this::$setUpRun = true;
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
            'name' => $this::$tagName
        ];

        $response = $this->actingAs($this::$user, 'api')
            ->post('/api/tag', $request);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'id',
            'name'
        ]);
    }

    /**
     * Test for double tag post
     */
    public function testDoubleTag() : void
    {
        $request = [
            'name' => $this::$tagName
        ];

        $response = $this->actingAs($this::$user, 'api')
            ->post('/api/tag', $request);

        $response->assertStatus(302)
            ->assertSessionHasErrors('name');
    }
}
