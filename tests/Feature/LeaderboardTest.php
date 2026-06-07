<?php

namespace Tests\Feature;

use App\Models\Quest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaderboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_leaderboard_shows_users_without_email(): void
    {
        $user = User::factory()->create([
            'name' => 'Top Player',
            'email' => 'top@example.com',
            'total_exp' => 500,
            'level' => 3,
        ]);

        $user->quests()->create([
            'title' => 'Completed quest',
            'difficulty' => 'boss',
            'status' => 'completed',
            'reward_exp' => Quest::rewardForDifficulty('boss'),
            'completed_at' => now(),
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/leaderboard');

        $response
            ->assertOk()
            ->assertSee('Top Player')
            ->assertSee('Level 3')
            ->assertDontSee('top@example.com');
    }
}
