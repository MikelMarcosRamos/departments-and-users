<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_visit_home_ok(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }

    public function test_see_application_name_on_title_and_h1()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('<title>' . config('app.name'), false);
        $response->assertSee(config('app.name') . '</a></h1>', false);
    }

    public function test_see_departments_and_users_links()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Departments</a>', false);
        $response->assertSee('Users</a>', false);
    }
}
