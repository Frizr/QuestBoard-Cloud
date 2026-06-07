<?php

namespace Tests\Feature;

use App\Models\Quest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_quest_with_automatic_reward(): void
    {
        $user = User::factory()->create();
        $category = $user->categories()->create([
            'name' => 'Project',
            'color' => '#7C3AED',
        ]);

        $response = $this
            ->actingAs($user)
            ->post('/quests', [
                'title' => 'Prepare cloud deployment',
                'description' => 'Review hosting requirements.',
                'category_id' => $category->id,
                'difficulty' => 'hard',
                'status' => 'pending',
                'deadline' => '2026-06-10 10:00:00',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/quests');

        $this->assertDatabaseHas('quests', [
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Prepare cloud deployment',
            'difficulty' => 'hard',
            'status' => 'pending',
            'reward_exp' => 200,
        ]);
    }

    public function test_completed_quest_updates_exp_and_does_not_duplicate_when_edited(): void
    {
        $user = User::factory()->create();
        $quest = $user->quests()->create([
            'title' => 'Private mission',
            'difficulty' => 'normal',
            'status' => 'pending',
            'reward_exp' => Quest::rewardForDifficulty('normal'),
        ]);

        $this
            ->actingAs($user)
            ->patch("/quests/{$quest->id}", [
                'title' => 'Private mission',
                'description' => null,
                'category_id' => null,
                'difficulty' => 'normal',
                'status' => 'completed',
                'deadline' => null,
            ])
            ->assertSessionHasNoErrors();

        $this->assertSame(100, $user->refresh()->total_exp);
        $this->assertSame(1, $user->level);

        $this
            ->actingAs($user)
            ->patch("/quests/{$quest->id}", [
                'title' => 'Private mission edited',
                'description' => null,
                'category_id' => null,
                'difficulty' => 'normal',
                'status' => 'completed',
                'deadline' => null,
            ])
            ->assertSessionHasNoErrors();

        $this->assertSame(100, $user->refresh()->total_exp);
        $this->assertSame(1, $user->level);
    }

    public function test_authenticated_user_can_view_the_dashboard(): void
    {
        $user = User::factory()->create();
        $user->quests()->create([
            'title' => 'Review mission board',
            'description' => 'Confirm the RPG dashboard renders.',
            'difficulty' => 'epic',
            'status' => 'in_progress',
            'reward_exp' => Quest::rewardForDifficulty('epic'),
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/dashboard');

        $response
            ->assertOk()
            ->assertSee('Adventurer Dashboard')
            ->assertSee('Review mission board')
            ->assertSee('Epic');
    }

    public function test_user_cannot_update_another_users_quest(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $quest = $owner->quests()->create([
            'title' => 'Private quest',
            'difficulty' => 'normal',
            'status' => 'pending',
            'reward_exp' => Quest::rewardForDifficulty('normal'),
        ]);

        $response = $this
            ->actingAs($otherUser)
            ->patch("/quests/{$quest->id}", [
                'title' => 'Changed',
                'description' => null,
                'category_id' => null,
                'difficulty' => 'boss',
                'status' => 'completed',
                'deadline' => null,
            ]);

        $response->assertForbidden();
        $this->assertSame('Private quest', $quest->fresh()->title);
    }

    public function test_user_cannot_assign_another_users_category_to_a_quest(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $otherCategory = $otherUser->categories()->create([
            'name' => 'Other category',
            'color' => '#FBBF24',
        ]);

        $response = $this
            ->actingAs($user)
            ->post('/quests', [
                'title' => 'Invalid category quest',
                'description' => null,
                'category_id' => $otherCategory->id,
                'difficulty' => 'easy',
                'status' => 'pending',
                'deadline' => null,
            ]);

        $response->assertSessionHasErrors('category_id');
    }
}
