<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagsApiTest extends TestCase
{
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
     * Test post a tag
     *
     * @return void
     */
    public function testPostTag()
    {
        $request = [
            'name' => 'testTag'
        ];

        $response = $this->actingAs($this->user, 'api')
            ->post('/api/tag', $request);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'id',
            'name'
        ]);
    }
}
