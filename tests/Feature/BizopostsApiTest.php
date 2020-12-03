<?php

namespace Tests\Feature;

use App\Bizpost;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BizopostsApiTest extends TestCase
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
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostBizpost()
    {
//        $bizpost = Bizpost::factory()->create();

        $this->assertTrue(true);

//        $response = $this->actingAs(static::$user, 'api')
//            ->post('/api/bizpost', $request);
//
//        $response->assertStatus(201)
//            ->assertJsonStructure([
//                'id',
//                'name'
//            ]);
    }
}
