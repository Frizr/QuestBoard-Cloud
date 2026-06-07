<x-app-layout>
    @php
        $difficultyBadges = [
            'easy' => 'border-emerald-300/30 bg-emerald-500/15 text-emerald-100',
            'normal' => 'border-sky-300/30 bg-sky-500/15 text-sky-100',
            'hard' => 'border-purple-300/30 bg-purple-500/15 text-purple-100',
            'epic' => 'border-amber-300/50 bg-amber-300/15 text-amber-100',
            'boss' => 'border-red-300/40 bg-red-500/15 text-red-100',
        ];
        $statusBadges = [
            'pending' => 'border-slate-400/30 bg-slate-500/10 text-slate-200',
            'in_progress' => 'border-purple-300/30 bg-purple-500/15 text-purple-100',
            'completed' => 'border-emerald-300/30 bg-emerald-500/15 text-emerald-100',
        ];
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">QuestBoard</p>
                <h1 class="mt-2 text-2xl font-black text-white sm:text-3xl">Adventurer Dashboard</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-400">
                    Track active quests, upcoming deadlines, and your current productivity level.
                </p>
            </div>
            <a href="{{ route('quests.create') }}" class="inline-flex items-center justify-center rounded-md bg-purple-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-purple-950/30 transition hover:-translate-y-0.5 hover:bg-purple-400">
                New Quest
            </a>
        </div>
    </x-slot>

    <div class="px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            @if (session('status'))
                <div class="rounded-md border border-emerald-300/30 bg-emerald-500/15 px-4 py-3 text-sm font-semibold text-emerald-100">
                    {{ session('status') }}
                </div>
            @endif

            <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-7">
                @foreach ([
                    ['label' => 'Total quests', 'value' => $stats['total'], 'tone' => 'text-white'],
                    ['label' => 'Pending', 'value' => $stats['pending'], 'tone' => 'text-slate-200'],
                    ['label' => 'In progress', 'value' => $stats['inProgress'], 'tone' => 'text-purple-200'],
                    ['label' => 'Completed', 'value' => $stats['completed'], 'tone' => 'text-emerald-200'],
                    ['label' => 'Overdue', 'value' => $stats['overdue'], 'tone' => 'text-red-200'],
                    ['label' => 'Total EXP', 'value' => $stats['totalExp'], 'tone' => 'text-amber-200'],
                    ['label' => 'Level', 'value' => $stats['level'], 'tone' => 'text-white'],
                ] as $card)
                    <div class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-4 shadow-xl shadow-purple-950/10 transition hover:-translate-y-0.5 hover:border-purple-300/30">
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400">{{ $card['label'] }}</p>
                        <p class="mt-3 text-3xl font-black {{ $card['tone'] }}">{{ $card['value'] }}</p>
                    </div>
                @endforeach
            </section>

            <section class="grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
                <div class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-5 shadow-xl shadow-purple-950/20">
                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-purple-200">Level Progress</p>
                            <div class="mt-2 flex items-end gap-3">
                                <span class="text-5xl font-black leading-none text-white">{{ $stats['level'] }}</span>
                                <div class="pb-1">
                                    <p class="font-semibold text-amber-200">Current Level</p>
                                    <p class="text-sm text-slate-400">{{ $stats['currentLevelExp'] }} / {{ $stats['nextLevelExp'] }} EXP</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full sm:max-w-sm">
                            <div class="flex justify-between text-xs font-bold uppercase tracking-wide text-slate-400">
                                <span>Progress</span>
                                <span>{{ $stats['levelProgress'] }}%</span>
                            </div>
                            <div class="mt-2 h-3 overflow-hidden rounded-full bg-white/10 ring-1 ring-white/10">
                                <div class="h-full rounded-full bg-amber-300 shadow-[0_0_24px_rgba(251,191,36,0.45)]" style="width: {{ $stats['levelProgress'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-5 shadow-xl shadow-purple-950/20">
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-amber-300">Upcoming Deadlines</p>
                    <div class="mt-4 space-y-3">
                        @forelse ($upcomingQuests as $quest)
                            <a href="{{ route('quests.show', $quest) }}" class="block rounded-md border border-white/10 bg-white/[0.04] p-3 transition hover:border-amber-300/30 hover:bg-white/[0.07]">
                                <div class="flex items-center justify-between gap-3">
                                    <p class="truncate font-semibold text-white">{{ $quest->title }}</p>
                                    <span class="whitespace-nowrap text-xs font-bold text-amber-200">{{ $quest->deadline?->format('M d') }}</span>
                                </div>
                                <p class="mt-1 text-xs text-slate-500">{{ $quest->category?->name ?? 'Uncategorized' }}</p>
                            </a>
                        @empty
                            <p class="rounded-md border border-dashed border-white/10 p-4 text-sm text-slate-500">No upcoming deadlines.</p>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="grid gap-4 xl:grid-cols-3">
                @foreach ($columns as $status => $label)
                    @php($columnQuests = $boardQuests->get($status, collect()))
                    <div class="rounded-lg border border-white/10 bg-white/[0.035] p-4 shadow-xl shadow-purple-950/10">
                        <div class="mb-4 flex items-center justify-between gap-3">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Mission Lane</p>
                                <h2 class="mt-1 font-bold text-white">{{ $label }}</h2>
                            </div>
                            <span class="rounded-full border border-white/10 bg-[#0F172A] px-2.5 py-1 text-xs font-black text-amber-200">{{ $columnQuests->count() }}</span>
                        </div>

                        <div class="space-y-3">
                            @forelse ($columnQuests as $quest)
                                <a href="{{ route('quests.show', $quest) }}" class="block rounded-lg border border-white/10 bg-[#1E293B] p-4 shadow-lg shadow-purple-950/10 transition hover:-translate-y-0.5 hover:border-purple-300/40">
                                    <div class="flex flex-wrap gap-2">
                                        @if ($quest->isOverdue())
                                            <span class="rounded-full border border-red-300/40 bg-red-500/15 px-2.5 py-1 text-xs font-bold text-red-100">Overdue</span>
                                        @endif
                                        <span class="rounded-full border px-2.5 py-1 text-xs font-bold {{ $difficultyBadges[$quest->difficulty] }}">
                                            {{ $difficulties[$quest->difficulty] }}
                                        </span>
                                        <span class="rounded-full border px-2.5 py-1 text-xs font-bold {{ $statusBadges[$quest->status] }}">
                                            {{ $columns[$quest->status] }}
                                        </span>
                                    </div>
                                    <h3 class="mt-3 break-words font-bold text-white">{{ $quest->title }}</h3>
                                    <p class="mt-2 text-sm text-slate-400">{{ $quest->category?->name ?? 'Uncategorized' }}</p>
                                    <div class="mt-4 flex items-center justify-between text-xs font-semibold text-slate-500">
                                        <span>{{ $quest->reward_exp }} EXP</span>
                                        <span>{{ $quest->deadline ? $quest->deadline->format('M d, Y') : 'No deadline' }}</span>
                                    </div>
                                </a>
                            @empty
                                <div class="rounded-lg border border-dashed border-white/15 bg-white/[0.03] p-6 text-center text-sm text-slate-500">
                                    No quests here.
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </section>

            <section class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-5 shadow-xl shadow-purple-950/20">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-amber-300">Recent Quests</p>
                        <h2 class="mt-2 text-xl font-bold text-white">Latest activity</h2>
                    </div>
                    <a href="{{ route('quests.index') }}" class="text-sm font-bold text-purple-200 transition hover:text-white">View all</a>
                </div>
                <div class="mt-5 overflow-x-auto">
                    <table class="min-w-full divide-y divide-white/10 text-left text-sm">
                        <thead class="text-xs font-bold uppercase tracking-wide text-slate-500">
                            <tr>
                                <th class="py-3 pr-4">Quest</th>
                                <th class="px-4 py-3">Category</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Difficulty</th>
                                <th class="py-3 pl-4 text-right">EXP</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @forelse ($recentQuests as $quest)
                                <tr class="transition hover:bg-white/[0.04]">
                                    <td class="py-4 pr-4">
                                        <a href="{{ route('quests.show', $quest) }}" class="font-semibold text-white hover:text-amber-200">{{ $quest->title }}</a>
                                    </td>
                                    <td class="px-4 py-4 text-slate-400">{{ $quest->category?->name ?? 'Uncategorized' }}</td>
                                    <td class="px-4 py-4 text-slate-400">{{ $columns[$quest->status] }}</td>
                                    <td class="px-4 py-4 text-slate-400">{{ $difficulties[$quest->difficulty] }}</td>
                                    <td class="py-4 pl-4 text-right font-bold text-amber-200">{{ $quest->reward_exp }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-500">No quests yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
