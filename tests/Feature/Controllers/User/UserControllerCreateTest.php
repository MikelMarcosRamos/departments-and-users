<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_visit_ok(): void
    {
        $response = $this->get(route('users.create'));

        $response->assertStatus(200)
            ->assertSee('New User</h2>', false)
            ->assertSee('name="name"', false);
    }

    public function test_displays_save_and_cancel_buttons(): void
    {
        $response = $this->get(route('users.create'));

        $response->assertSee(route('users.index'))
            ->assertSee('<form method="POST" action="' . route('users.store') . '"', false)
            ->assertSee('Cancel')
            ->assertSee('Save');
    }

    public function test_create_user_requires_name_and_email()
    {
        $response = $this->post(route('users.store'), [
            // Intentionally missing name and email fields
        ]);

        $response->assertSessionHasErrors(['name', 'email']);
    }

    public function test_create_user_requires_valid_email()
    {
        $response = $this->post(route('users.store'), [
            'name' => fake()->name(),
            'email' => fake()->name() // Intentionally wrong email
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_create_user_ok()
    {
        $user = User::factory()->make();

        $response = $this->post(route('users.store'), [
            'name' => $user->name,
            'email' => $user->email
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('message', 'User created!');

        $this->get($response->getTargetUrl())
            ->assertSee('User created!')
            ->assertSee($user->name)
            ->assertSee($user->email);
    }

    public function test_create_user_requires_unique_email()
    {
        $user = User::factory()->create();

        $response = $this->post(route('users.store'), [
            'name' => $user->name,
            'email' => $user->email
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
