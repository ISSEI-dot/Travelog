<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_view_their_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }

    /** @test */
    public function authenticated_user_can_access_profile_edit_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile/edit');

        $response->assertStatus(200);
        $response->assertSee('名前'); // 編集フォーム内に「名前」が表示されていることを確認
        $response->assertSee('メールアドレス'); // 編集フォーム内に「メールアドレス」が表示されていることを確認
    }

    /** @test */
    public function authenticated_user_can_update_their_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patch('/profile', [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);

        $response->assertRedirect('/profile');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }

    /** @test */
    public function profile_update_fails_if_required_fields_are_missing()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patch('/profile', []);

        $response->assertSessionHasErrors(['name', 'email']);
    }

    /** @test */
    public function unauthenticated_user_cannot_access_profile_routes()
    {
        $response = $this->get('/profile');
        $response->assertRedirect('/login');

        $response = $this->get('/profile/edit');
        $response->assertRedirect('/login');

        $response = $this->patch('/profile', []);
        $response->assertRedirect('/login');
    }
}
