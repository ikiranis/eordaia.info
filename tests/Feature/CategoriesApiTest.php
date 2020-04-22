<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesApiTest extends TestCase
{
    use WithFaker;

    protected static $user;
    protected static string $categoryName;
    protected static bool $setUpRun = false;

    /**
     * Setup actions
     */
    public function setUp() : void
    {
        parent::setUp();

        if (!static::$setUpRun) {
            static::$user = User::first();
            static::$categoryName = $this->faker->text(rand(10, 15));

            static::$setUpRun = true;
        }
    }

    /**
     * Test post a tag
     *
     * @return void
     */
    public function testPostCategory() : void
    {
        $request = [
            'name' => static::$categoryName
        ];

        $response = $this->actingAs(static::$user, 'api')
            ->post('/api/category', $request);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name'
            ]);
    }

    /**
     * Test for double category post
     */
    public function testDoubleCategory() : void
    {
        $request = [
            'name' => static::$categoryName
        ];

        $response = $this->actingAs(static::$user, 'api')
            ->post('/api/category', $request);

//        $errors = session('errors');
//        print_r($errors->get('name')[0]);

        $response->assertStatus(302)
            ->assertSessionHasErrors('name');
    }
}
