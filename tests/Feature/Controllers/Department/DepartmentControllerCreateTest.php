<?php

namespace Tests\Feature\Controllers\Department;

use Tests\TestCase;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentControllerCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_visit_ok(): void
    {
        $response = $this->get(route('departments.create'));

        $response->assertStatus(200)
            ->assertSee('New Department</h2>', false)
            ->assertSee('name="name"', false)
            ->assertSee('name="department_id"', false);
    }
    
    public function test_displays_save_and_cancel_buttons(): void
    {
        $response = $this->get(route('departments.create'));

        $response->assertSee(route('departments.index'))
            ->assertSee('<form method="POST" action="' . route('departments.store') . '"', false)
            ->assertSee('Cancel')
            ->assertSee('Save');
    }

    public function test_create_department_requires_name(): void
    {
        $response = $this->post(route('departments.store'), [
            // Intentionally missing name
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_create_department_ok(): void
    {
        $department = Department::factory()->make();

        $response = $this->post(route('departments.store'), [
            'name' => $department->name,
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('departments.index'))
            ->assertSessionHas('message', 'Department created!');

        $this->get($response->getTargetUrl())
            ->assertSee('Department created!')
            ->assertSee($department->name);
    }

    public function test_displays_deparment_name_for_parent(): void
    {
        $department = Department::factory()->create();

        $response = $this->get(route('departments.create'));

        $response->assertStatus(200)
            ->assertSee($department->name);
    }

    public function test_department_can_have_a_parent(): void
    {
        $parent = Department::factory()->create();
        $department = Department::factory()->make();

        $response = $this->post(route('departments.store'), [
            'name' => $department->name,
            'department_id' => $parent->id,
        ]);

        $createdDeparment = Department::whereName($department->name)->firstOrFail();

        $this->assertEquals($parent->id, $createdDeparment->department_id);

        $response->assertStatus(302);
    }

}
