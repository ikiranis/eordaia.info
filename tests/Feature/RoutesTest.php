<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoutesTest extends TestCase
{
    /**
     * Test home page
     *
     * @return void
     */
    public function testHomePage() : void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('Eordaia.info');
    }
}
