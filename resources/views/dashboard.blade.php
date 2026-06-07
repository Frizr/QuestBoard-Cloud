<x-app-layout>
    @php
        $statusBadges = [
            'todo' => 'border-slate-500/30 bg-slate-500/10 text-slate-200',
            'in_progress' => 'border-purple-300/30 bg-purple-500/15 text-purple-100',
            'done' => 'border-emerald-300/30 bg-emerald-500/15 text-emerald-100',
        ];
        $priorityBadges = [
            'low' => 'border-slate-400/30 bg-slate-500/10 text-slate-200',
            'medium' => 'border-purple-300/30 bg-purple-500/15 text-purple-100',
            'high' => 'border-amber-300/50 bg-amber-300/15 text-amber-100',
        ];
        $difficultyLabels = [
            'low' => 'Common',
            'medium' => 'Rare',
            'high' => 'Epic',
        ];
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">QuestBoard</p>
                <h1 class="mt-2 text-2xl font-black text-white sm:text-3xl">Adventurer Dashboard</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-400">
                    Plan your quests, move work across the board, and build EXP by finishing the right missions.
                </p>
            </div>
            <div class="rounded-md border border-amber-300/20 bg-amber-300/10 px-4 py-3 text-sm font-semibold text-amber-100">
                {{ $stats['xp'] }} EXP earned
            </div>
        </div>
    </x-slot>

    <div class="px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            @if (session('status'))
                <div class="mb-6 rounded-md border border-emerald-300/30 bg-emerald-500/15 px-4 py-3 text-sm font-semibold text-emerald-100">
                    {{ session('status') }}
                </div>
            @endif

            <section class="grid gap-4 lg:grid-cols-[1.25fr_0.75fr]">
                <div class="rounded-lg border border-white/10 bg-[#120f22]/90 p-5 shadow-2xl shadow-purple-950/20">
                    <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-purple-200">Level Progress</p>
                            <div class="mt-2 flex items-end gap-3">
                                <span class="text-5xl font-black leading-none text-white">{{ $stats['level'] }}</span>
                                <div class="pb-1">
                                    <p class="font-semibold text-amber-200">Current Rank</p>
                                    <p class="text-sm text-slate-400">{{ $stats['currentLevelXp'] }} / {{ $stats['nextLevelXp'] }} EXP to next level</p>
                                </div>
                            </div>
                        </div>
                        <div class="min-w-full md:min-w-80">
                            <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-wide text-slate-400">
                                <span>EXP</span>
                                <span>{{ $stats['levelProgress'] }}%</span>
                            </div>
                            <div class="mt-2 h-3 overflow-hidden rounded-full bg-white/10 ring-1 ring-white/10">
                                <div class="h-full rounded-full bg-amber-300 shadow-[0_0_24px_rgba(252,211,77,0.45)]" style="width: {{ $stats['levelProgress'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4 transition hover:border-purple-300/30 hover:bg-white/[0.06]">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Total</p>
                        <p class="mt-2 text-2xl font-black text-white">{{ $stats['total'] }}</p>
                    </div>
                    <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4 transition hover:border-purple-300/30 hover:bg-white/[0.06]">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Active</p>
                        <p class="mt-2 text-2xl font-black text-purple-200">{{ $stats['active'] }}</p>
                    </div>
                    <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4 transition hover:border-emerald-300/30 hover:bg-white/[0.06]">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Completed</p>
                        <p class="mt-2 text-2xl font-black text-emerald-200">{{ $stats['completed'] }}</p>
                    </div>
                    <div class="rounded-lg border border-white/10 bg-white/[0.04] p-4 transition hover:border-amber-300/30 hover:bg-white/[0.06]">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Due Soon</p>
                        <p class="mt-2 text-2xl font-black text-amber-200">{{ $stats['dueSoon'] }}</p>
                    </div>
                </div>
            </section>

            <div class="mt-6 grid gap-6 lg:grid-cols-[360px_1fr]">
                <section class="rounded-lg border border-white/10 bg-[#120f22]/90 p-5 shadow-xl shadow-purple-950/20">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-amber-300">New Quest</p>
                            <h2 class="mt-2 text-xl font-bold text-white">Post a mission</h2>
                        </div>
                        <span class="rounded-full border border-purple-300/30 bg-purple-500/15 px-3 py-1 text-xs font-bold text-purple-100">+ EXP</span>
                    </div>

                    <form method="POST" action="{{ route('tasks.store') }}" class="mt-5 space-y-4">
                        @csrf

                        <div>
                            <label for="title" class="block text-sm font-semibold text-slate-300">Quest title</label>
                            <input id="title" name="title" type="text" value="{{ old('title') }}" required maxlength="120" class="mt-1 block w-full rounded-md border-white/10 bg-[#0d0a18] text-slate-100 shadow-sm transition placeholder:text-slate-600 focus:border-purple-300 focus:ring-purple-300">
                            @error('title')
                                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-300">Briefing</label>
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-white/10 bg-[#0d0a18] text-slate-100 shadow-sm transition placeholder:text-slate-600 focus:border-purple-300 focus:ring-purple-300">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-1">
                            <div>
                                <label for="status" class="block text-sm font-semibold text-slate-300">Status</label>
                                <select id="status" name="status" class="mt-1 block w-full rounded-md border-white/10 bg-[#0d0a18] text-slate-100 shadow-sm focus:border-purple-300 focus:ring-purple-300">
                                    @foreach ($columns as $value => $label)
                                        <option value="{{ $value }}" @selected(old('status', 'todo') === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="priority" class="block text-sm font-semibold text-slate-300">Difficulty</label>
                                <select id="priority" name="priority" class="mt-1 block w-full rounded-md border-white/10 bg-[#0d0a18] text-slate-100 shadow-sm focus:border-purple-300 focus:ring-purple-300">
                                    @foreach ($priorities as $value => $label)
                                        <option value="{{ $value }}" @selected(old('priority', 'medium') === $value)>{{ $difficultyLabels[$value] ?? $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="due_date" class="block text-sm font-semibold text-slate-300">Due date</label>
                            <input id="due_date" name="due_date" type="date" value="{{ old('due_date') }}" class="mt-1 block w-full rounded-md border-white/10 bg-[#0d0a18] text-slate-100 shadow-sm focus:border-purple-300 focus:ring-purple-300">
                        </div>

                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-md bg-purple-500 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-purple-950/30 transition hover:-translate-y-0.5 hover:bg-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:ring-offset-2 focus:ring-offset-[#120f22]">
                            Add Quest
                        </button>
                    </form>
                </section>

                <section class="grid gap-4 xl:grid-cols-3">
                    @foreach ($columns as $status => $label)
                        @php
                            $columnTasks = $tasks->get($status, collect());
                        @endphp

                        <div class="rounded-lg border border-white/10 bg-white/[0.035] p-4 shadow-xl shadow-purple-950/10">
                            <div class="mb-4 flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Mission Lane</p>
                                    <h3 class="mt-1 font-bold text-white">{{ $label }}</h3>
                                </div>
                                <span class="rounded-full border border-white/10 bg-[#120f22] px-2.5 py-1 text-xs font-black text-amber-200">{{ $columnTasks->count() }}</span>
                            </div>

                            <div class="space-y-3">
                                @forelse ($columnTasks as $task)
                                    <article class="group rounded-lg border border-white/10 bg-[#120f22] p-4 shadow-lg shadow-purple-950/10 transition hover:-translate-y-0.5 hover:border-purple-300/40 hover:bg-[#171229]">
                                        <div class="flex items-start justify-between gap-3">
                                            <div class="min-w-0">
                                                <div class="flex flex-wrap gap-2">
                                                    <span class="rounded-full border px-2.5 py-1 text-xs font-bold {{ $statusBadges[$task->status] ?? 'border-slate-500/30 bg-slate-500/10 text-slate-200' }}">
                                                        {{ $columns[$task->status] ?? ucfirst($task->status) }}
                                                    </span>
                                                    <span class="rounded-full border px-2.5 py-1 text-xs font-bold {{ $priorityBadges[$task->priority] ?? 'border-slate-400/30 bg-slate-500/10 text-slate-200' }}">
                                                        {{ $difficultyLabels[$task->priority] ?? ucfirst($task->priority) }}
                                                    </span>
                                                </div>
                                                <h4 class="mt-3 break-words text-base font-bold text-white">{{ $task->title }}</h4>
                                                @if ($task->description)
                                                    <p class="mt-2 max-h-24 overflow-hidden whitespace-pre-line text-sm leading-6 text-slate-400">{{ $task->description }}</p>
                                                @endif
                                            </div>
                                            <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this quest?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-md border border-red-300/20 px-2 py-1 text-xs font-bold text-red-200 transition hover:bg-red-500/15">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>

                                        <div class="mt-4 flex flex-wrap items-center gap-2 text-xs font-semibold text-slate-400">
                                            <span class="rounded-md bg-white/5 px-2.5 py-1">
                                                {{ $task->priority === 'high' ? '120' : ($task->priority === 'medium' ? '80' : '40') }} EXP
                                            </span>
                                            @if ($task->due_date)
                                                <span class="rounded-md bg-white/5 px-2.5 py-1">
                                                    Due {{ $task->due_date->format('M d, Y') }}
                                                </span>
                                            @endif
                                        </div>

                                        <form method="POST" action="{{ route('tasks.update', $task) }}" class="mt-4 grid gap-3 border-t border-white/10 pt-4">
                                            @csrf
                                            @method('PATCH')

                                            <input type="text" name="title" value="{{ $task->title }}" maxlength="120" required class="block w-full rounded-md border-white/10 bg-[#0d0a18] text-sm text-slate-100 shadow-sm focus:border-purple-300 focus:ring-purple-300">
                                            <textarea name="description" rows="2" class="block w-full rounded-md border-white/10 bg-[#0d0a18] text-sm text-slate-100 shadow-sm focus:border-purple-300 focus:ring-purple-300">{{ $task->description }}</textarea>

                                            <div class="grid grid-cols-1 gap-3 sm:grid-cols-3 xl:grid-cols-1 2xl:grid-cols-3">
                                                <select name="status" class="rounded-md border-white/10 bg-[#0d0a18] text-sm text-slate-100 shadow-sm focus:border-purple-300 focus:ring-purple-300">
                                                    @foreach ($columns as $value => $statusLabel)
                                                        <option value="{{ $value }}" @selected($task->status === $value)>{{ $statusLabel }}</option>
                                                    @endforeach
                                                </select>

                                                <select name="priority" class="rounded-md border-white/10 bg-[#0d0a18] text-sm text-slate-100 shadow-sm focus:border-purple-300 focus:ring-purple-300">
                                                    @foreach ($priorities as $value => $priorityLabel)
                                                        <option value="{{ $value }}" @selected($task->priority === $value)>{{ $difficultyLabels[$value] ?? $priorityLabel }}</option>
                                                    @endforeach
                                                </select>

                                                <input type="date" name="due_date" value="{{ optional($task->due_date)->format('Y-m-d') }}" class="rounded-md border-white/10 bg-[#0d0a18] text-sm text-slate-100 shadow-sm focus:border-purple-300 focus:ring-purple-300">
                                            </div>

                                            <button type="submit" class="rounded-md border border-amber-300/30 bg-amber-300/10 px-3 py-2 text-sm font-bold text-amber-100 transition hover:border-amber-200/60 hover:bg-amber-300/20">
                                                Save Quest
                                            </button>
                                        </form>
                                    </article>
                                @empty
                                    <div class="rounded-lg border border-dashed border-white/15 bg-white/[0.03] p-6 text-center text-sm text-slate-500">
                                        No quests in this lane.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </section>
            </div>

            <section class="mt-6 rounded-lg border border-white/10 bg-[#120f22]/90 p-4 shadow-xl shadow-purple-950/20 sm:p-5">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-amber-300">Quest Ledger</p>
                        <h2 class="mt-2 text-xl font-bold text-white">All missions</h2>
                    </div>
                    <p class="text-sm text-slate-400">{{ $stats['completionRate'] }}% completion rate</p>
                </div>

                <div class="mt-5 overflow-x-auto">
                    <table class="min-w-full divide-y divide-white/10 text-left text-sm">
                        <thead class="text-xs font-bold uppercase tracking-wide text-slate-500">
                            <tr>
                                <th class="py-3 pr-4">Quest</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Difficulty</th>
                                <th class="px-4 py-3">Due</th>
                                <th class="py-3 pl-4 text-right">EXP</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @forelse ($allTasks as $task)
                                <tr class="transition hover:bg-white/[0.04]">
                                    <td class="max-w-xs py-4 pr-4">
                                        <p class="truncate font-semibold text-white">{{ $task->title }}</p>
                                        @if ($task->description)
                                            <p class="mt-1 truncate text-xs text-slate-500">{{ $task->description }}</p>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="whitespace-nowrap rounded-full border px-2.5 py-1 text-xs font-bold {{ $statusBadges[$task->status] ?? 'border-slate-500/30 bg-slate-500/10 text-slate-200' }}">
                                            {{ $columns[$task->status] ?? ucfirst($task->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="whitespace-nowrap rounded-full border px-2.5 py-1 text-xs font-bold {{ $priorityBadges[$task->priority] ?? 'border-slate-400/30 bg-slate-500/10 text-slate-200' }}">
                                            {{ $difficultyLabels[$task->priority] ?? ucfirst($task->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-slate-400">
                                        {{ $task->due_date ? $task->due_date->format('M d, Y') : 'Open' }}
                                    </td>
                                    <td class="py-4 pl-4 text-right font-bold text-amber-200">
                                        {{ $task->priority === 'high' ? '120' : ($task->priority === 'medium' ? '80' : '40') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-500">No quests posted yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
