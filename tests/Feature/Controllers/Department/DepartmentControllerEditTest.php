<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentControllerEditTest extends TestCase
{
    use RefreshDatabase;

    private Department $department;

    function setUp(): void
    {
        parent::setUp();

        $this->department = Department::factory()->create();
    }

    public function test_visit_ok(): void
    {
        $response = $this->get(route('departments.edit', $this->department->id));

        $response->assertStatus(200)
            ->assertSee($this->department->name)
            ->assertSee($this->department->email);
    }

    public function test_visit_error_department_not_found(): void
    {
        $nonExistentDepartmentId = 999;

        $response = $this->get(route('departments.edit', $nonExistentDepartmentId));

        $response->assertStatus(404);
    }
}
