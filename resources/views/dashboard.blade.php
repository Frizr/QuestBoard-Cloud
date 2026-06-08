<x-app-layout>
    @php
        $displayLevel = $stats['level'] ?? 1;
        $rankTitle = match (true) {
            $displayLevel >= 20 => 'Grandmaster',
            $displayLevel >= 12 => 'Champion',
            $displayLevel >= 7 => 'Vanguard',
            $displayLevel >= 3 => 'Pathfinder',
            default => 'Initiate',
        };
        $allBoardQuests = $boardQuests->flatten(1);
        $highlightQuest = $allBoardQuests->firstWhere('difficulty', 'boss')
            ?? $allBoardQuests->firstWhere('difficulty', 'epic')
            ?? $allBoardQuests->firstWhere('status', 'in_progress')
            ?? $allBoardQuests->first();
        $remainingExp = max(0, $stats['nextLevelExp'] - $stats['currentLevelExp']);
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="qb-section-kicker">QuestBoard</p>
                <h1 class="mt-2 qb-heading text-3xl sm:text-4xl">Guild Hall</h1>
                <span class="sr-only">Adventurer Dashboard</span>
                <p class="mt-2 text-base text-slate-400">Welcome back, Adventurer</p>
            </div>
            <a href="{{ route('quests.create') }}" class="qb-primary">
                <span class="text-lg leading-none">+</span>
                Post Quest
            </a>
        </div>
    </x-slot>

    <div class="qb-page-shell">
        <div class="space-y-7">
            @if (session('status'))
                <div class="rounded-md border border-emerald-400/30 bg-emerald-500/15 px-4 py-3 text-sm font-semibold text-emerald-100">
                    {{ session('status') }}
                </div>
            @endif

            <section class="qb-panel relative overflow-hidden p-6 lg:p-8">
                <div class="absolute right-0 top-0 h-72 w-72 rounded-full bg-violet/20 blur-3xl"></div>
                <div class="relative grid gap-7 lg:grid-cols-[1fr_360px] lg:items-center">
                    <div class="flex flex-col gap-6 sm:flex-row sm:items-center">
                        <div class="grid h-24 w-24 shrink-0 place-items-center rounded-full border border-royal bg-obsidian/70 font-display text-5xl font-bold text-royal shadow-gold">
                            {{ $displayLevel }}
                        </div>
                        <div>
                            <p class="qb-section-kicker">Rank</p>
                            <h2 class="mt-2 font-display text-3xl font-bold text-white">Level {{ $displayLevel }} {{ $rankTitle }}</h2>
                            <p class="mt-2 text-slate-400">{{ number_format($stats['totalExp']) }} total EXP earned across completed quests.</p>
                        </div>
                    </div>

                    <x-exp-progress-bar
                        :progress="$stats['levelProgress']"
                        :current="$stats['currentLevelExp']"
                        :next="$stats['nextLevelExp']"
                    />
                </div>
            </section>

            <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <x-stat-card label="Total Quests" :value="$stats['total']" hint="All posted missions" symbol="T" />
                <x-stat-card label="Pending" :value="$stats['pending']" hint="Waiting on the board" symbol="P" tone="text-amber-100" />
                <x-stat-card label="In Progress" :value="$stats['inProgress']" hint="Active field work" symbol="A" tone="text-sky-100" />
                <x-stat-card label="Completed" :value="$stats['completed']" hint="Rewards claimed" symbol="C" tone="text-emerald-100" />
                <x-stat-card label="Overdue" :value="$stats['overdue']" hint="Needs attention" symbol="!" tone="text-red-200" />
                <x-stat-card label="Total EXP" :value="number_format($stats['totalExp'])" hint="Productivity reward" symbol="XP" tone="text-royal" />
                <x-stat-card label="Current Level" :value="$displayLevel" hint="{{ $rankTitle }} tier" symbol="LV" />
                <x-stat-card label="Next Level" :value="$remainingExp" hint="EXP remaining" symbol=">" tone="text-violet-100" />
            </section>

            @if ($highlightQuest)
                <section class="qb-panel overflow-hidden">
                    <div class="grid gap-0 lg:grid-cols-[1fr_340px]">
                        <div class="p-6 lg:p-8">
                            <p class="qb-section-kicker">{{ $highlightQuest->difficulty === 'boss' ? 'Boss Quest' : 'Active Quest' }}</p>
                            <h2 class="mt-3 qb-heading text-3xl">{{ $highlightQuest->title }}</h2>
                            <p class="mt-4 max-w-3xl text-sm leading-7 text-slate-400">{{ $highlightQuest->description ?: 'No briefing provided.' }}</p>
                            <div class="mt-5 flex flex-wrap gap-2">
                                @if ($highlightQuest->isOverdue())
                                    <x-status-badge value="overdue" overdue />
                                @endif
                                <x-difficulty-badge :value="$highlightQuest->difficulty" :labels="$difficulties" />
                                <x-status-badge :value="$highlightQuest->status" :labels="$columns" />
                            </div>
                        </div>
                        <div class="border-t border-border bg-obsidian/35 p-6 lg:border-l lg:border-t-0">
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Reward</p>
                            <p class="mt-3 font-display text-5xl font-bold text-royal qb-gold-glow">{{ $highlightQuest->reward_exp }}</p>
                            <p class="text-sm text-slate-400">EXP</p>
                            <div class="mt-6 border-t border-border pt-5 text-sm text-slate-400">
                                <p><span class="font-bold text-slate-200">Category:</span> {{ $highlightQuest->category?->name ?? 'Uncategorized' }}</p>
                                <p class="mt-2"><span class="font-bold text-slate-200">Deadline:</span> {{ $highlightQuest->deadline ? $highlightQuest->deadline->format('M d, Y H:i') : 'No deadline' }}</p>
                            </div>
                            <a href="{{ route('quests.show', $highlightQuest) }}" class="qb-gold mt-6 w-full">Open Briefing</a>
                        </div>
                    </div>
                </section>
            @endif

            <section class="grid gap-6 xl:grid-cols-[1fr_360px]">
                <div class="space-y-5">
                    <div class="flex items-end justify-between gap-4 border-b border-border pb-3">
                        <div>
                            <p class="qb-section-kicker">Mission Lanes</p>
                            <h2 class="mt-2 qb-heading text-2xl">Quest Board</h2>
                        </div>
                        <a href="{{ route('quests.index') }}" class="text-sm font-bold text-violet-200 transition hover:text-white">View all</a>
                    </div>

                    <div class="grid gap-4 xl:grid-cols-3">
                        @foreach ($columns as $status => $label)
                            @php($columnQuests = $boardQuests->get($status, collect())->take(3))
                            <div class="rounded-lg border border-border/80 bg-panel/45 p-4">
                                <div class="mb-4 flex items-center justify-between">
                                    <h3 class="font-display text-lg font-bold text-white">{{ $label }}</h3>
                                    <span class="rounded-md border border-border bg-obsidian/60 px-2.5 py-1 text-xs font-black text-royal">{{ $boardQuests->get($status, collect())->count() }}</span>
                                </div>
                                <div class="space-y-3">
                                    @forelse ($columnQuests as $quest)
                                        <a href="{{ route('quests.show', $quest) }}" class="block rounded-lg border border-border/70 bg-card/80 p-4 transition hover:-translate-y-0.5 hover:border-violet/50">
                                            <div class="flex flex-wrap gap-2">
                                                <x-difficulty-badge :value="$quest->difficulty" :labels="$difficulties" />
                                                @if ($quest->isOverdue())
                                                    <x-status-badge value="overdue" overdue />
                                                @endif
                                            </div>
                                            <h4 class="mt-3 break-words font-bold text-white">{{ $quest->title }}</h4>
                                            <div class="mt-4 flex items-center justify-between text-xs font-bold text-slate-500">
                                                <span>{{ $quest->reward_exp }} EXP</span>
                                                <span>{{ $quest->deadline ? $quest->deadline->format('M d') : 'No deadline' }}</span>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="rounded-lg border border-dashed border-border p-5 text-center text-sm text-slate-500">No quests here.</div>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <aside class="space-y-6">
                    <section class="qb-panel-soft p-5">
                        <p class="qb-section-kicker">Upcoming Deadlines</p>
                        <div class="mt-5 space-y-3">
                            @forelse ($upcomingQuests as $quest)
                                <a href="{{ route('quests.show', $quest) }}" class="block rounded-md border border-border/80 bg-obsidian/35 p-4 transition hover:border-royal/40 hover:bg-royal/5">
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="truncate font-bold text-white">{{ $quest->title }}</p>
                                        <span class="whitespace-nowrap text-xs font-black text-royal">{{ $quest->deadline?->format('M d') }}</span>
                                    </div>
                                    <p class="mt-1 text-xs text-slate-500">{{ $quest->category?->name ?? 'Uncategorized' }}</p>
                                </a>
                            @empty
                                <p class="rounded-md border border-dashed border-border p-4 text-sm text-slate-500">No upcoming deadlines.</p>
                            @endforelse
                        </div>
                    </section>

                    <section class="qb-panel-soft p-5">
                        <p class="qb-section-kicker">Recent Activity</p>
                        <div class="mt-5 space-y-3">
                            @forelse ($recentQuests as $quest)
                                <a href="{{ route('quests.show', $quest) }}" class="block rounded-md border border-border/80 bg-obsidian/35 p-4 transition hover:border-violet/40 hover:bg-violet/5">
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="truncate font-bold text-white">{{ $quest->title }}</p>
                                        <span class="whitespace-nowrap text-xs font-black text-royal">{{ $quest->reward_exp }} EXP</span>
                                    </div>
                                    <p class="mt-1 text-xs text-slate-500">{{ $columns[$quest->status] }} - {{ $difficulties[$quest->difficulty] }}</p>
                                </a>
                            @empty
                                <p class="rounded-md border border-dashed border-border p-4 text-sm text-slate-500">No quest activity yet.</p>
                            @endforelse
                        </div>
                    </section>
                </aside>
            </section>
        </div>
    </div>
</x-app-layout>
