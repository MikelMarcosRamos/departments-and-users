<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentControllerDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy_department_ok(): void
    {
        $department = Department::factory()->create();

        $response = $this->delete(route('departments.destroy', $department->id));

        $this->assertNull(Department::find($department->id));

        $response->assertStatus(302)
            ->assertRedirect(route('departments.index'));

        $response->assertStatus(302)
            ->assertRedirect(route('departments.index'))
            ->assertSessionHas('message', 'Department deleted!');

        $this->get($response->getTargetUrl())
            ->assertSee('Department deleted!');
    }

    public function test_destroy_non_existing_department_error(): void
    {
        $nonExistingDepartmentId = 999;

        $response = $this->delete(route('departments.destroy', $nonExistingDepartmentId));

        $response->assertStatus(404);
    }
}
