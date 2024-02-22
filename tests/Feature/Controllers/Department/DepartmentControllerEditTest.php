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

    public function test_displays_save_and_cancel_buttons(): void
    {
        $response = $this->get(route('departments.edit', $this->department->id));

        $response->assertSee(route('departments.index'))
            ->assertSee('<form method="POST" action="' . route('departments.update', $this->department->id) . '"', false)
            ->assertSee('Cancel')
            ->assertSee('Save');
    }

    public function test_create_department_requires_name(): void
    {
        $response = $this->post(route('departments.update', $this->department->id), [
            // Intentionally missing name
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_edit_department_name_ok()
    {
        $response = $this->post(route('departments.update', $this->department->id), [
            'name' => $this->department->name . '-edited',
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('departments.index'))
            ->assertSessionHas('message', 'Department edited!');

        $this->get($response->getTargetUrl())
            ->assertSee('Department edited!')
            ->assertSee($this->department->name . '-edited');
    }
}
