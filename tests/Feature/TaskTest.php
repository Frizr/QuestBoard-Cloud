<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_task(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/tasks', [
                'title' => 'Prepare cloud deployment',
                'description' => 'Review hosting requirements.',
                'status' => 'todo',
                'priority' => 'high',
                'due_date' => '2026-06-10',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/dashboard');

        $this->assertDatabaseHas('tasks', [
            'user_id' => $user->id,
            'title' => 'Prepare cloud deployment',
            'status' => 'todo',
            'priority' => 'high',
        ]);
    }

    public function test_authenticated_user_can_view_the_quest_dashboard(): void
    {
        $user = User::factory()->create();
        $user->tasks()->create([
            'title' => 'Review mission board',
            'description' => 'Confirm the RPG dashboard renders.',
            'status' => 'in_progress',
            'priority' => 'high',
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

    public function test_user_cannot_update_another_users_task(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = $owner->tasks()->create([
            'title' => 'Private task',
            'status' => 'todo',
            'priority' => 'medium',
        ]);

        $response = $this
            ->actingAs($otherUser)
            ->patch("/tasks/{$task->id}", [
                'title' => 'Changed',
                'status' => 'done',
                'priority' => 'high',
            ]);

        $response->assertForbidden();
        $this->assertSame('Private task', $task->fresh()->title);
    }
}
