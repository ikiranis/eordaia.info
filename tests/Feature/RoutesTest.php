<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class RoutesTest extends TestCase
{
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
     * Test admin page
     *
     * @return void
     */
    public function testAdminPage()
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin');

        $response->assertStatus(200)
            ->assertSee('Admin Page');
    }
}
