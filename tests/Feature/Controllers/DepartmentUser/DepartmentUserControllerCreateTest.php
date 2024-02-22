<?php

namespace Tests\Feature\Controllers\Department;

use Tests\TestCase;
use App\Models\User;
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
        $user = User::factory()->create();

        $response = $this->get(route('departmentsUsers.create', $this->department->id));

        $response->assertStatus(200)
            ->assertSee('Add User')
            ->assertSee($this->department->name)
            ->assertSee('name="user_id"', false);
    }
    
    public function test_displays_add_and_cancel_buttons(): void
    {
        $user = User::factory()->create();

        $response = $this->get(route('departmentsUsers.create', $this->department->id));

        $response->assertSee(route('departments.edit', $this->department->id))
            ->assertSee('<form method="POST" action="' . route('departmentsUsers.store', $this->department->id) . '"', false)
            ->assertSee('Cancel')
            ->assertSee('Add');
    }

    public function test_add_requires_user(): void
    {
        $response = $this->post(route('departmentsUsers.store', $this->department->id), [
            // Intentionally missing name
        ]);

        $response->assertSessionHasErrors(['user_id']);
    }

    public function test_add_user_ok(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('departmentsUsers.store',  $this->department->id), [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('departments.edit', $this->department->id))
            ->assertSessionHas('message', 'User added!');

        $this->get($response->getTargetUrl())
            ->assertSee('User added!')
            ->assertSee($user->name);
    }

    public function test_no_users_return(): void
    {
        $response = $this->get(route('departmentsUsers.create', $this->department->id));

        $response->assertStatus(302)
            ->assertRedirect(route('departments.edit', $this->department->id))
            ->assertSessionHas('message', 'No users to add!');
    }

    public function test_no_more_users_return(): void
    {
        $user = User::factory()->create();
        $this->department->users()->attach($user->id);

        $response = $this->get(route('departmentsUsers.create', $this->department->id));

        $response->assertStatus(302)
            ->assertRedirect(route('departments.edit', $this->department->id))
            ->assertSessionHas('message', 'No users to add!');
    }
}
