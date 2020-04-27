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
    public function testAdminPage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin');

        $response->assertStatus(200)
            ->assertSee('Admin Page');
    }

    /**
     * Test admin users page
     *
     * @return void
     */
    public function testAdminUsersPage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/users');

        $response->assertStatus(200)
            ->assertSee('Χρήστες');
    }

    /**
     * Test admin posts page
     *
     * @return void
     */
    public function testAdminPostsPage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/posts');

        $response->assertStatus(200)
            ->assertSee('Δημοσιεύσεις');
    }

    /**
     * Test admin post create page
     *
     * @return void
     */
    public function testAdminPostCreatePage() : void
    {
        $response = $this->actingAs(static::$user, 'web')
            ->get('/admin/posts/create');

        $response->assertStatus(200)
            ->assertSee('Εισαγωγή δημοσίευσης');
    }
}
