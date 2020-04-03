<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutesTest extends TestCase
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
     * Test admin page
     *
     * @return void
     */
    public function testAdminPage()
    {
        $response = $this->actingAs($this->user, 'web')
            ->get('/admin');

        $response->assertStatus(200);

        $response->assertSee('Admin Page');
    }
}
