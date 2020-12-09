<?php

namespace Tests\Feature;

use App\Business;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BusinessApiTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected static bool $setUpRun = false;

    /**
     * Setup actions
     */
    public function setUp() : void
    {
        parent::setUp();

        if (!static::$setUpRun) {
            static::$setUpRun = true;
        }
    }

    /**
     * Test getting a Business
     */
    public function testGetBusiness()
    {
        $response = $this->get('/api/business/'. 'id');

        $response->assertStatus(200);
    }

    /**
     * Test if email exists in database
     */
    public function testIfEmailExists()
    {
        $business = Business::factory()->create();

        $response = $this->get('/api/checkBusiness/'. $business->email);

//        print_r($response->json());

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'slug',
                'address',
                'email'
            ]);
    }

    /**
     * Test posting a Business
     *
     * @return void
     */
    public function testPostBusiness()
    {
//        $bizpost = Bizpost::factory()->make();

        $response = $this->post('/api/business/', []);

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
     * Test updating a Business
     */
    public function testUpdateBusiness()
    {
        $response = $this->patch('/api/business/' . 'id', []);

        $response->assertStatus(200);
    }

    /**
     * Test deleting a Business
     */
    public function testDeleteBusiness()
    {
        $response = $this->delete('/api/business/' . 'id');

        $response->assertStatus(200);
    }
}
