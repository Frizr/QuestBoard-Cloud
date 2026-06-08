<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class LeaderboardController extends Controller
{
    public function __invoke(): View
    {
        return view('leaderboard.index', [
            'leaders' => User::query()
                ->withCount(['quests as completed_quests_count' => fn ($query) => $query->where('status', 'completed')])
                ->orderByDesc('total_exp')
                ->orderByDesc('level')
                ->orderBy('name')
                ->take(10)
                ->get(['id', 'name', 'level', 'total_exp', 'avatar_path', 'avatar_template']),
        ]);
    }
}
