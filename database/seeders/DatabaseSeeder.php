<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Quest;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::query()->updateOrCreate(
            ['email' => 'demo@questboard.test'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );

        $categories = collect([
            ['name' => 'Work', 'color' => '#7C3AED', 'emblem' => 'shield'],
            ['name' => 'Study', 'color' => '#3B82F6', 'emblem' => 'book'],
            ['name' => 'Personal', 'color' => '#22C55E', 'emblem' => 'star'],
            ['name' => 'Health', 'color' => '#EF4444', 'emblem' => 'flame'],
            ['name' => 'Finance', 'color' => '#F59E0B', 'emblem' => 'crown'],
            ['name' => 'Home', 'color' => '#14B8A6', 'emblem' => 'shield'],
            ['name' => 'Hobby', 'color' => '#EC4899', 'emblem' => 'star'],
            ['name' => 'Project', 'color' => '#FBBF24', 'emblem' => 'hammer'],
            ['name' => 'Gaming', 'color' => '#A855F7', 'emblem' => 'sword'],
            ['name' => 'Other', 'color' => '#94A3B8', 'emblem' => 'compass'],
        ])->mapWithKeys(function (array $category) use ($user) {
            $model = $user->categories()->updateOrCreate(
                ['name' => $category['name']],
                ['color' => $category['color'], 'emblem' => $category['emblem']],
            );

            return [$category['name'] => $model];
        });

        if ($user->quests()->doesntExist()) {
            $samples = [
                [
                    'category' => 'Project',
                    'title' => 'Deploy QuestBoard to staging',
                    'description' => 'Prepare environment variables, run migrations, and verify the production build.',
                    'difficulty' => 'epic',
                    'status' => 'in_progress',
                    'deadline' => now()->addDays(3),
                ],
                [
                    'category' => 'Study',
                    'title' => 'Review Laravel authorization',
                    'description' => 'Review route model binding and owner checks for categories and quests.',
                    'difficulty' => 'normal',
                    'status' => 'completed',
                    'deadline' => now()->subDay(),
                    'completed_at' => now()->subHours(4),
                ],
                [
                    'category' => 'Health',
                    'title' => 'Morning workout',
                    'description' => 'Complete a focused 30 minute workout session.',
                    'difficulty' => 'easy',
                    'status' => 'pending',
                    'deadline' => now()->addDay(),
                ],
                [
                    'category' => 'Work',
                    'title' => 'Finish cloud documentation',
                    'description' => 'Write AWS EC2 deployment notes and firewall configuration.',
                    'difficulty' => 'hard',
                    'status' => 'pending',
                    'deadline' => now()->subDay(),
                ],
                [
                    'category' => 'Personal',
                    'title' => 'Clean weekly task backlog',
                    'description' => 'Archive old tasks and choose the next priority quests.',
                    'difficulty' => 'normal',
                    'status' => 'completed',
                    'deadline' => now()->subDays(2),
                    'completed_at' => now()->subDay(),
                ],
            ];

            foreach ($samples as $sample) {
                $difficulty = $sample['difficulty'];

                $user->quests()->create([
                    'category_id' => $categories[$sample['category']]->id,
                    'title' => $sample['title'],
                    'description' => $sample['description'],
                    'difficulty' => $difficulty,
                    'status' => $sample['status'],
                    'reward_exp' => Quest::rewardForDifficulty($difficulty),
                    'deadline' => $sample['deadline'],
                    'completed_at' => $sample['completed_at'] ?? null,
                ]);
            }
        }

        $totalExp = (int) $user->quests()->where('status', 'completed')->sum('reward_exp');

        $user->forceFill([
            'total_exp' => $totalExp,
            'level' => User::levelForExp($totalExp),
        ]);

        $user->save();
    }
}
