<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesApiTest extends TestCase
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
     * Test post a tag
     *
     * @return void
     */
    public function testPostCategory()
    {
        $request = [
            'name' => $this->faker->text(rand(5, 10))
        ];

        $response = $this->actingAs($this->user, 'api')
            ->post('/api/category', $request);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'id',
            'name'
        ]);
    }
}
