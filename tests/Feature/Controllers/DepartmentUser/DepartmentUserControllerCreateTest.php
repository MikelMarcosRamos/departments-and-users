<?php

namespace Tests\Feature\Controllers\Department;

use Tests\TestCase;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentUserControllerCreateTest extends TestCase
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
        $response = $this->get(route('departmentsUsers.create', $this->department->id));

        $response->assertStatus(200)
            ->assertSee('Add User')
            ->assertSee($this->department->name)
            ->assertSee('name="user"', false);
    }
    
    

}
