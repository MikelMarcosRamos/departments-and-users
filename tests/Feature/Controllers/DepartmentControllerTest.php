<?php

namespace Tests\Feature;

use Tests\TestCase;

class DepartmentControllerTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_visit_index_ok(): void
    {
        $response = $this->get(route('departments.index'));

        $response->assertStatus(200);
    }
}
