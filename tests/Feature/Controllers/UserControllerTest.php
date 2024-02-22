<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_visit_index_ok(): void
    {
        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertSee('Users</h2>', false);
    }
}
