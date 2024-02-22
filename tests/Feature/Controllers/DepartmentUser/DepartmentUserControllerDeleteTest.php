<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentUserControllerDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy_department_ok(): void
    {
        $department = Department::factory()->create();
        $user = User::factory()->create();
        $department->users()->attach($user->id);

        $response = $this->delete(route('departmentsUsers.destroy', $department->id), [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('departments.edit', $department->id));

        $response->assertStatus(302)
            ->assertRedirect(route('departments.edit', $department->id))
            ->assertSessionHas('message', 'User detached!');

        $this->get($response->getTargetUrl())
            ->assertSee('User detached!')
            ->assertDontSee($user->name);
    }

    public function test_destroy_non_existing_department_error(): void
    {
        $nonExistingDepartmentId = 999;

        $response = $this->delete(route('departmentsUsers.destroy', $nonExistingDepartmentId));

        $response->assertStatus(404);
    }
}
