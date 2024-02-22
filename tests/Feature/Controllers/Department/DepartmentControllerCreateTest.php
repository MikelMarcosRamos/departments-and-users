<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentControllerCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_visit_ok(): void
    {
        $response = $this->get(route('departments.create'));

        $response->assertStatus(200)
            ->assertSee('New Department</h2>', false)
            ->assertSee('name="name"', false);
    }
    
    public function test_displays_save_and_cancel_buttons(): void
    {
        $response = $this->get(route('departments.create'));

        $response->assertSee(route('departments.index'))
            ->assertSee('<form method="POST" action="' . route('departments.store') . '"', false)
            ->assertSee('Cancel')
            ->assertSee('Save');
    }
}
