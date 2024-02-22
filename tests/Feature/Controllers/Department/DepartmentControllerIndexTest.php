<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentControllerIndexTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_visit_index_ok(): void
    {
        $response = $this->get(route('departments.index'));

        $response->assertStatus(200)
            ->assertSee('Departments</h2>', false)
            ->assertSee('No departments.');
    }

    public function test_displays_create_department_button(): void
    {
        $response = $this->get(route('departments.index'));

        $response->assertStatus(200)
                 ->assertSee('Create Department')
                 ->assertSee(route('departments.create'));    
    }

    public function test_displays_department_names(): void
    {
        $department1 = Department::factory()->create();
        $department2 = Department::factory()->create();

        $response = $this->get(route('departments.index'));

        $response->assertStatus(200)
            ->assertDontSee('No departments.')
            ->assertSee($department1->name)
            ->assertSee($department2->name);
    }

    public function test_displays_edit_and_delete_buttons(): void
    {
        $department = Department::factory()->create();

        $response = $this->get(route('departments.index'));

        $response->assertSee(route('departments.edit', $department->id))
            ->assertSee(route('departments.destroy', $department->id))
            ->assertSee('<form method="POST" action="' . route('departments.destroy', $department->id) . '"', false)
            ->assertSee('Edit')
            ->assertSee('Delete');
    }
}