<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy_user_ok(): void
    {
        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', $user->id));

        $this->assertNull(User::find($user->id));

        $response->assertStatus(302)
            ->assertRedirect(route('users.index'));

        $response->assertStatus(302)
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('message', 'User deleted!');

        $this->get($response->getTargetUrl())
            ->assertSee('User deleted!');
    }

    public function test_destroy_non_existing_user_error(): void
    {
        $nonExistingUserId = 999;

        $response = $this->delete(route('users.destroy', $nonExistingUserId));

        $response->assertStatus(404);
    }
}
