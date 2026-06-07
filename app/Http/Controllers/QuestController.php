<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class QuestController extends Controller
{
    public function index(Request $request): View
    {
        $query = $request->user()->quests()->with('category');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->string('search')->toString().'%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->string('difficulty')->toString());
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        match ($request->string('sort')->toString()) {
            'deadline' => $query->orderByRaw('deadline is null')->orderBy('deadline'),
            default => $query->latest(),
        };

        return view('quests.index', [
            'quests' => $query->paginate(10)->withQueryString(),
            'categories' => $request->user()->categories()->orderBy('name')->get(),
            'difficulties' => Quest::DIFFICULTIES,
            'statuses' => Quest::STATUSES,
            'filters' => $request->only(['search', 'category_id', 'difficulty', 'status', 'sort']),
        ]);
    }

    public function create(Request $request): View
    {
        return view('quests.create', [
            'categories' => $request->user()->categories()->orderBy('name')->get(),
            'difficulties' => Quest::DIFFICULTIES,
            'statuses' => Quest::STATUSES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedQuest($request);
        $validated['reward_exp'] = Quest::rewardForDifficulty($validated['difficulty']);
        $validated['completed_at'] = $validated['status'] === 'completed' ? now() : null;

        $request->user()->quests()->create($validated);
        $this->syncUserProgress($request->user());

        return redirect()->route('quests.index')->with('status', 'Quest created.');
    }

    public function show(Request $request, Quest $quest): View
    {
        $this->authorizeOwner($request, $quest);

        return view('quests.show', [
            'quest' => $quest->load('category'),
            'difficulties' => Quest::DIFFICULTIES,
            'statuses' => Quest::STATUSES,
        ]);
    }

    public function edit(Request $request, Quest $quest): View
    {
        $this->authorizeOwner($request, $quest);

        return view('quests.edit', [
            'quest' => $quest,
            'categories' => $request->user()->categories()->orderBy('name')->get(),
            'difficulties' => Quest::DIFFICULTIES,
            'statuses' => Quest::STATUSES,
        ]);
    }

    public function update(Request $request, Quest $quest): RedirectResponse
    {
        $this->authorizeOwner($request, $quest);

        $validated = $this->validatedQuest($request);
        $validated['reward_exp'] = Quest::rewardForDifficulty($validated['difficulty']);
        $validated['completed_at'] = $validated['status'] === 'completed'
            ? ($quest->completed_at ?? now())
            : null;

        $quest->update($validated);
        $this->syncUserProgress($request->user());

        return redirect()->route('quests.show', $quest)->with('status', 'Quest updated.');
    }

    public function destroy(Request $request, Quest $quest): RedirectResponse
    {
        $this->authorizeOwner($request, $quest);

        $quest->delete();
        $this->syncUserProgress($request->user());

        return redirect()->route('quests.index')->with('status', 'Quest deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedQuest(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'category_id' => [
                'nullable',
                Rule::exists('categories', 'id')->where('user_id', $request->user()->id),
            ],
            'difficulty' => ['required', Rule::in(array_keys(Quest::DIFFICULTIES))],
            'status' => ['required', Rule::in(array_keys(Quest::STATUSES))],
            'deadline' => ['nullable', 'date'],
        ]);
    }

    private function authorizeOwner(Request $request, Quest $quest): void
    {
        abort_unless($quest->user_id === $request->user()->id, 403);
    }

    private function syncUserProgress(User $user): void
    {
        $totalExp = (int) $user->quests()->where('status', 'completed')->sum('reward_exp');

        $user->forceFill([
            'total_exp' => $totalExp,
            'level' => User::levelForExp($totalExp),
        ])->save();
    }
}
