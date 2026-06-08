<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="qb-section-kicker">Mission Briefing</p>
                <h1 class="mt-2 qb-heading text-3xl sm:text-4xl">Quest Briefing</h1>
                <p class="mt-2 text-base text-slate-400">Review contract terms, reward, deadline, and current status.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('quests.index') }}" class="qb-secondary">Back to Quest Log</a>
                <a href="{{ route('quests.edit', $quest) }}" class="qb-primary">Edit Quest</a>
            </div>
        </div>
    </x-slot>

    <div class="qb-page-shell">
        <div class="mx-auto max-w-6xl space-y-6">
            @if (session('status'))
                <div class="rounded-md border border-emerald-400/30 bg-emerald-500/15 px-4 py-3 text-sm font-semibold text-emerald-100">
                    {{ session('status') }}
                </div>
            @endif

            <article class="qb-panel overflow-hidden">
                <div class="relative min-h-56 border-b border-border bg-[radial-gradient(circle_at_25%_20%,rgba(109,40,217,0.36),transparent_30%),linear-gradient(135deg,#15111d_0%,#172033_55%,#0B1020_100%)] p-6 sm:p-8">
                    <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-card to-transparent"></div>
                    <div class="relative">
                        <div class="flex flex-wrap gap-2">
                            @if ($quest->isOverdue())
                                <x-status-badge value="overdue" overdue />
                            @endif
                            <x-difficulty-badge :value="$quest->difficulty" :labels="$difficulties" />
                            <x-status-badge :value="$quest->status" :labels="$statuses" />
                        </div>
                        <h2 class="mt-8 max-w-4xl break-words font-display text-4xl font-extrabold text-violet-100 qb-title-glow sm:text-5xl">
                            {{ $quest->title }}
                        </h2>
                    </div>
                </div>

                <div class="grid gap-0 lg:grid-cols-[1fr_360px]">
                    <section class="p-6 sm:p-8">
                        <p class="qb-section-kicker">Quest Briefing</p>
                        <div class="mt-5 whitespace-pre-line text-base leading-8 text-slate-300">
                            {{ $quest->description ?: 'No briefing provided for this quest.' }}
                        </div>
                    </section>

                    <aside class="border-t border-border bg-obsidian/30 p-6 lg:border-l lg:border-t-0 sm:p-8">
                        <div class="rounded-lg border border-royal/30 bg-royal/10 p-5">
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Reward</p>
                            <p class="mt-3 font-display text-5xl font-bold text-royal qb-gold-glow">{{ $quest->reward_exp }}</p>
                            <p class="text-sm text-slate-400">EXP</p>
                        </div>

                        <dl class="mt-6 space-y-4 text-sm">
                            <div class="rounded-md border border-border bg-panel/60 p-4">
                                <dt class="font-bold uppercase tracking-wide text-slate-500">Category</dt>
                                <dd class="mt-1 text-slate-200">{{ $quest->category?->name ?? 'Uncategorized' }}</dd>
                            </div>
                            <div class="rounded-md border border-border bg-panel/60 p-4">
                                <dt class="font-bold uppercase tracking-wide text-slate-500">Difficulty</dt>
                                <dd class="mt-2"><x-difficulty-badge :value="$quest->difficulty" :labels="$difficulties" /></dd>
                            </div>
                            <div class="rounded-md border border-border bg-panel/60 p-4">
                                <dt class="font-bold uppercase tracking-wide text-slate-500">Status</dt>
                                <dd class="mt-2"><x-status-badge :value="$quest->status" :labels="$statuses" /></dd>
                            </div>
                            <div class="rounded-md border border-border bg-panel/60 p-4">
                                <dt class="font-bold uppercase tracking-wide text-slate-500">Deadline</dt>
                                <dd class="mt-1 text-slate-200">{{ $quest->deadline ? $quest->deadline->format('M d, Y H:i') : 'No deadline' }}</dd>
                            </div>
                            <div class="rounded-md border border-border bg-panel/60 p-4">
                                <dt class="font-bold uppercase tracking-wide text-slate-500">Completed At</dt>
                                <dd class="mt-1 text-slate-200">{{ $quest->completed_at ? $quest->completed_at->format('M d, Y H:i') : 'Pending' }}</dd>
                            </div>
                        </dl>

                        <form method="POST" action="{{ route('quests.destroy', $quest) }}" class="mt-6" onsubmit="return confirm('Delete this quest?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="qb-danger w-full">Delete Quest</button>
                        </form>
                    </aside>
                </div>
            </article>
        </div>
    </div>
</x-app-layout>
