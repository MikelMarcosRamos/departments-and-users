<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerEditTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_visit_ok(): void
    {
        $response = $this->get(route('users.edit', $this->user->id));

        $response->assertStatus(200)
            ->assertSee($this->user->name)
            ->assertSee($this->user->email);
    }

    public function test_visit_error_user_not_found(): void
    {
        $nonExistentUserId = 999;

        $response = $this->get(route('users.edit', $nonExistentUserId));

        $response->assertStatus(404);
    }

    public function test_displays_save_and_cancel_buttons(): void
    {
        $response = $this->get(route('users.edit', $this->user->id));

        $response->assertSee(route('users.index'))
            ->assertSee('<form method="POST" action="' . route('users.update', $this->user->id) . '"', false)
            ->assertSee('Cancel')
            ->assertSee('Save');
    }

    public function test_edit_user_requires_name_and_email()
    {
        $response = $this->post(route('users.update', $this->user->id), [
            // Intentionally missing name and email fields
        ]);

        $response->assertSessionHasErrors(['name', 'email']);
    }

    public function test_edit_user_requires_valid_email()
    {
        $response = $this->post(route('users.update', $this->user->id), [
            'name' => fake()->name(),
            'email' => fake()->name() // Intentionally wrong email
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_edit_user_ok()
    {
        $response = $this->post(route('users.update', $this->user->id), [
            'name' => $this->user->name . '-edited',
            'email' => $this->user->email . '-edited'
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('message', 'User edited!');

        $this->get($response->getTargetUrl())
            ->assertSee('User edited!')
            ->assertSee($this->user->name . '-edited')
            ->assertSee($this->user->email . '-edited');
    }

    public function test_edit_user_without_change_ok()
    {
        $response = $this->post(route('users.update', $this->user->id), [
            'name' => $this->user->name,
            'email' => $this->user->email
        ]);

        $this->get($response->getTargetUrl())
            ->assertSee('User edited!')
            ->assertSee($this->user->name)
            ->assertSee($this->user->email);
    }

    public function test_create_user_requires_unique_email()
    {
        $user = User::factory()->create();

        $response = $this->post(route('users.update', $this->user->id), [
            'name' => $user->name,
            'email' => $user->email
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
