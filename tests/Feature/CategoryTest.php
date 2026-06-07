<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_category(): void
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->post('/categories', [
                'name' => 'Study',
                'color' => '#3B82F6',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/categories');

        $this->assertDatabaseHas('categories', [
            'user_id' => $user->id,
            'name' => 'Study',
            'color' => '#3B82F6',
        ]);
    }

    public function test_user_cannot_edit_another_users_category(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = $owner->categories()->create([
            'name' => 'Private',
            'color' => '#7C3AED',
        ]);

        $this
            ->actingAs($otherUser)
            ->patch("/categories/{$category->id}", [
                'name' => 'Changed',
                'color' => '#FBBF24',
            ])
            ->assertForbidden();

        $this->assertSame('Private', $category->fresh()->name);
    }
}
