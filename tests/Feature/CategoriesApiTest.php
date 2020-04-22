<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesApiTest extends TestCase
{
    use WithFaker;

    protected static Authenticatable $user;
    protected static string $categoryName;

    /**
     * If true, setup has run at least once.
     *
     * @var boolean
     */
    protected static bool $setUpRun = false;

    /**
     * Setup actions
     */
    public function setUp() : void
    {
        parent::setUp();

        if (!static::$setUpRun) {
            $this::$user = User::first();
            $this::$categoryName = $this->faker->text(rand(10, 15));

            $this::$setUpRun = true;
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
            'name' => $this::$categoryName
        ];

        $response = $this->actingAs($this::$user, 'api')
            ->post('/api/category', $request);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'id',
            'name'
        ]);
    }

    public function testDoubleCategory() : void
    {
        $request = [
            'name' => $this::$categoryName
        ];

        $response = $this->actingAs($this::$user, 'api')
            ->post('/api/category', $request);

//        $errors = session('errors');
//        print_r($errors->get('name')[0]);

        $response->assertStatus(302)
            ->assertSessionHasErrors('name');
    }
}
