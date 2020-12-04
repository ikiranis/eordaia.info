<?php

namespace Tests\Feature;

use App\Bizpost;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BizpostsApiTest extends TestCase
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
     * Test getting a bizpost
     */
    public function testGetBizpost()
    {
        $response = $this->get('/api/bizpost/'. 'id');

        $response->assertStatus(200);
    }

    /**
     * Test posting a bizpost
     *
     * @return void
     */
    public function testPostBizpost()
    {
//        $bizpost = Bizpost::factory()->make();

        $response = $this->post('/api/bizpost/', []);

        $response->assertStatus(200);

//        $response = $this->actingAs(static::$user, 'api')
//            ->post('/api/bizpost', $request);
//
//        $response->assertStatus(201)
//            ->assertJsonStructure([
//                'id',
//                'name'
//            ]);
    }

    /**
     * Test updating a bizpost
     */
    public function testUpdateBizpost()
    {
        $response = $this->patch('/api/bizpost/' . 'id', []);

        $response->assertStatus(200);
    }

    /**
     * Test deleting a bizpost
     */
    public function testDeleteBizpost()
    {
        $response = $this->delete('/api/bizpost/' . 'id');

        $response->assertStatus(200);
    }
}
