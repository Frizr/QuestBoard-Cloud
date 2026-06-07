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
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">Quest Management</p>
                <h1 class="mt-2 text-2xl font-black text-white sm:text-3xl">Your quest log</h1>
                <p class="mt-2 text-sm text-slate-400">Search, filter, and sort every mission you own.</p>
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

            <section class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-5 shadow-xl shadow-purple-950/20">
                <form method="GET" action="{{ route('quests.index') }}" class="grid gap-4 lg:grid-cols-[1.2fr_repeat(4,1fr)_auto]">
                    <div>
                        <label for="search" class="block text-xs font-bold uppercase tracking-wide text-slate-400">Search</label>
                        <input id="search" name="search" type="text" value="{{ $filters['search'] ?? '' }}" placeholder="Quest title" class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 placeholder:text-slate-600 focus:border-purple-300 focus:ring-purple-300">
                    </div>
                    <div>
                        <label for="category_id" class="block text-xs font-bold uppercase tracking-wide text-slate-400">Category</label>
                        <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? '') == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="difficulty" class="block text-xs font-bold uppercase tracking-wide text-slate-400">Difficulty</label>
                        <select id="difficulty" name="difficulty" class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                            <option value="">All</option>
                            @foreach ($difficulties as $value => $label)
                                <option value="{{ $value }}" @selected(($filters['difficulty'] ?? '') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-xs font-bold uppercase tracking-wide text-slate-400">Status</label>
                        <select id="status" name="status" class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                            <option value="">All</option>
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" @selected(($filters['status'] ?? '') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="sort" class="block text-xs font-bold uppercase tracking-wide text-slate-400">Sort</label>
                        <select id="sort" name="sort" class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                            <option value="newest" @selected(($filters['sort'] ?? 'newest') === 'newest')>Newest</option>
                            <option value="deadline" @selected(($filters['sort'] ?? '') === 'deadline')>Deadline</option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="rounded-md bg-purple-500 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-purple-400">Apply</button>
                        <a href="{{ route('quests.index') }}" class="rounded-md border border-white/10 px-4 py-2.5 text-sm font-bold text-slate-200 transition hover:bg-white/10">Reset</a>
                    </div>
                </form>
            </section>

            <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($quests as $quest)
                    <article class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-5 shadow-xl shadow-purple-950/10 transition hover:-translate-y-0.5 hover:border-purple-300/40">
                        <div class="flex flex-wrap gap-2">
                            @if ($quest->isOverdue())
                                <span class="rounded-full border border-red-300/40 bg-red-500/15 px-2.5 py-1 text-xs font-bold text-red-100">Overdue</span>
                            @endif
                            <span class="rounded-full border px-2.5 py-1 text-xs font-bold {{ $difficultyBadges[$quest->difficulty] }}">
                                {{ $difficulties[$quest->difficulty] }}
                            </span>
                            <span class="rounded-full border px-2.5 py-1 text-xs font-bold {{ $statusBadges[$quest->status] }}">
                                {{ $statuses[$quest->status] }}
                            </span>
                        </div>

                        <h2 class="mt-4 text-lg font-bold text-white">{{ $quest->title }}</h2>
                        <p class="mt-2 max-h-20 overflow-hidden text-sm leading-6 text-slate-400">{{ $quest->description ?: 'No briefing provided.' }}</p>

                        <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                            <div class="rounded-md bg-white/[0.04] p-3">
                                <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Category</p>
                                <p class="mt-1 font-semibold text-slate-200">{{ $quest->category?->name ?? 'Uncategorized' }}</p>
                            </div>
                            <div class="rounded-md bg-white/[0.04] p-3">
                                <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Reward</p>
                                <p class="mt-1 font-semibold text-amber-200">{{ $quest->reward_exp }} EXP</p>
                            </div>
                        </div>

                        <div class="mt-5 flex flex-wrap items-center justify-between gap-3">
                            <p class="text-xs font-semibold text-slate-500">{{ $quest->deadline ? 'Due '.$quest->deadline->format('M d, Y H:i') : 'No deadline' }}</p>
                            <div class="flex gap-2">
                                <a href="{{ route('quests.show', $quest) }}" class="rounded-md border border-white/10 px-3 py-1.5 text-xs font-bold text-slate-200 transition hover:bg-white/10">Detail</a>
                                <a href="{{ route('quests.edit', $quest) }}" class="rounded-md border border-amber-300/30 px-3 py-1.5 text-xs font-bold text-amber-100 transition hover:bg-amber-300/10">Edit</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-lg border border-dashed border-white/15 p-10 text-center text-slate-500 md:col-span-2 xl:col-span-3">
                        No quests found.
                    </div>
                @endforelse
            </section>

            <div>
                {{ $quests->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
