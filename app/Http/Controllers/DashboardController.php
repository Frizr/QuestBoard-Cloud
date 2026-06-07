<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();
        $baseQuery = $user->quests();

        $totalQuests = (clone $baseQuery)->count();
        $pendingQuests = (clone $baseQuery)->where('status', 'pending')->count();
        $inProgressQuests = (clone $baseQuery)->where('status', 'in_progress')->count();
        $completedQuests = (clone $baseQuery)->where('status', 'completed')->count();
        $overdueQuests = (clone $baseQuery)
            ->where('status', '!=', 'completed')
            ->whereNotNull('deadline')
            ->where('deadline', '<', now())
            ->count();
        $currentLevelExp = $user->total_exp % 250;

        $boardQuests = $user->quests()
            ->with('category')
            ->orderByRaw("case status when 'pending' then 0 when 'in_progress' then 1 else 2 end")
            ->orderByRaw('deadline is null')
            ->orderBy('deadline')
            ->latest('updated_at')
            ->get()
            ->groupBy('status');

        return view('dashboard', [
            'columns' => Quest::STATUSES,
            'difficulties' => Quest::DIFFICULTIES,
            'boardQuests' => $boardQuests,
            'recentQuests' => $user->quests()->with('category')->latest()->take(5)->get(),
            'upcomingQuests' => $user->quests()
                ->with('category')
                ->where('status', '!=', 'completed')
                ->whereNotNull('deadline')
                ->where('deadline', '>=', now())
                ->orderBy('deadline')
                ->take(5)
                ->get(),
            'stats' => [
                'total' => $totalQuests,
                'pending' => $pendingQuests,
                'inProgress' => $inProgressQuests,
                'completed' => $completedQuests,
                'overdue' => $overdueQuests,
                'totalExp' => $user->total_exp,
                'level' => $user->level,
                'currentLevelExp' => $currentLevelExp,
                'nextLevelExp' => 250,
                'levelProgress' => (int) round(($currentLevelExp / 250) * 100),
            ],
        ]);
    }
}
