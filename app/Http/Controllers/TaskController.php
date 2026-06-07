<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $tasks = $request->user()
            ->tasks()
            ->orderByRaw("case priority when 'high' then 0 when 'medium' then 1 else 2 end")
            ->orderByRaw('due_date is null')
            ->orderBy('due_date')
            ->latest('updated_at')
            ->get()
            ->groupBy('status');
        $allTasks = $tasks->flatten(1);
        $totalTasks = $allTasks->count();
        $completedTasks = $allTasks->where('status', 'done')->count();
        $activeTasks = $totalTasks - $completedTasks;
        $dueSoonTasks = $allTasks
            ->filter(fn (Task $task) => $task->status !== 'done'
                && $task->due_date
                && $task->due_date->betweenIncluded(now()->startOfDay(), now()->addDays(7)->endOfDay()))
            ->count();
        $xp = $allTasks
            ->where('status', 'done')
            ->sum(fn (Task $task) => match ($task->priority) {
                'high' => 120,
                'medium' => 80,
                default => 40,
            });
        $levelSize = 500;
        $level = intdiv($xp, $levelSize) + 1;
        $currentLevelXp = $xp % $levelSize;

        return view('dashboard', [
            'columns' => Task::STATUSES,
            'priorities' => Task::PRIORITIES,
            'tasks' => $tasks,
            'allTasks' => $allTasks,
            'stats' => [
                'total' => $totalTasks,
                'active' => $activeTasks,
                'completed' => $completedTasks,
                'dueSoon' => $dueSoonTasks,
                'completionRate' => $totalTasks === 0 ? 0 : (int) round(($completedTasks / $totalTasks) * 100),
                'xp' => $xp,
                'level' => $level,
                'currentLevelXp' => $currentLevelXp,
                'nextLevelXp' => $levelSize,
                'levelProgress' => (int) round(($currentLevelXp / $levelSize) * 100),
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'string', 'in:'.implode(',', array_keys(Task::STATUSES))],
            'priority' => ['required', 'string', 'in:'.implode(',', array_keys(Task::PRIORITIES))],
            'due_date' => ['nullable', 'date'],
        ]);

        $request->user()->tasks()->create($validated);

        return redirect()->route('dashboard')->with('status', 'Task added.');
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->authorizeOwner($request, $task);

        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['sometimes', 'required', 'string', 'in:'.implode(',', array_keys(Task::STATUSES))],
            'priority' => ['sometimes', 'required', 'string', 'in:'.implode(',', array_keys(Task::PRIORITIES))],
            'due_date' => ['nullable', 'date'],
        ]);

        $task->update($validated);

        return redirect()->route('dashboard')->with('status', 'Task updated.');
    }

    public function destroy(Request $request, Task $task): RedirectResponse
    {
        $this->authorizeOwner($request, $task);

        $task->delete();

        return redirect()->route('dashboard')->with('status', 'Task deleted.');
    }

    private function authorizeOwner(Request $request, Task $task): void
    {
        abort_unless($task->user_id === $request->user()->id, 403);
    }
}
