<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_visit_ok(): void
    {
        $response = $this->get(route('users.index'));

        $response->assertStatus(200)
            ->assertSee('Users</h2>', false)
            ->assertSee('No users.');
    }

    public function test_displays_users_table(): void
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.index'));

        $response->assertStatus(200)
            ->assertSee($user->name)
            ->assertSee($user->email);
    }

    public function test_displays_edit_and_delete_buttons(): void
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.index'));

        $response->assertSee(route('users.edit', $user->id))
            ->assertSee(route('users.destroy', $user->id))
            ->assertSee('<form method="POST" action="' . route('users.destroy', $user->id) . '"', false)
            ->assertSee('Edit')
            ->assertSee('Delete');
    }

    public function test_displays_create_user_button(): void
    {
        $response = $this->get(route('users.index'));

        $response = $this->get('/users');

        $response->assertStatus(200)
                 ->assertSee('Create User')
                 ->assertSee(route('users.create'));    
    }

    public function test_pagination(): void
    {
        $users = User::factory(15)->create();

        $response = $this->get(route('users.index'));

        $response->assertSee($users[9]->name);
        $response->assertDontSee($users[10]->name);

        $response->assertSee('Next');
    }
}
