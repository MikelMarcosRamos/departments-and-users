<?php

namespace Tests\Feature;

use Tests\TestCase;

class DepartmentControllerIndexTest extends TestCase
{
    public function test_visit_index_ok(): void
    {
        $response = $this->get(route('departments.index'));

        $response->assertStatus(200)
            ->assertSee('Departments</h2>', false)
            ->assertSee('No departments.');
    }
}