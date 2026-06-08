<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="qb-section-kicker">Mission Journal</p>
                <h1 class="mt-2 qb-heading text-3xl sm:text-4xl">Quest Log</h1>
                <p class="mt-2 text-base text-slate-400">Manage your active missions and daily objectives.</p>
            </div>
            <a href="{{ route('quests.create') }}" class="qb-primary">
                <span class="text-lg leading-none">+</span>
                New Quest
            </a>
        </div>
    </x-slot>

    <div class="qb-page-shell">
        <div class="space-y-6">
            @if (session('status'))
                <div class="rounded-md border border-emerald-400/30 bg-emerald-500/15 px-4 py-3 text-sm font-semibold text-emerald-100">
                    {{ session('status') }}
                </div>
            @endif

            <section class="qb-panel-soft p-5">
                <form method="GET" action="{{ route('quests.index') }}" class="grid gap-4 lg:grid-cols-[1.4fr_repeat(4,minmax(0,1fr))_auto]">
                    <div>
                        <label for="search" class="block text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Search</label>
                        <input id="search" name="search" type="text" value="{{ $filters['search'] ?? '' }}" placeholder="Search quests by title..." class="qb-field">
                    </div>

                    <div>
                        <label for="category_id" class="block text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Category</label>
                        <select id="category_id" name="category_id" class="qb-field">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? '') == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="difficulty" class="block text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Difficulty</label>
                        <select id="difficulty" name="difficulty" class="qb-field">
                            <option value="">Any Difficulty</option>
                            @foreach ($difficulties as $value => $label)
                                <option value="{{ $value }}" @selected(($filters['difficulty'] ?? '') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Status</label>
                        <select id="status" name="status" class="qb-field">
                            <option value="">All Statuses</option>
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" @selected(($filters['status'] ?? '') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="sort" class="block text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Sort</label>
                        <select id="sort" name="sort" class="qb-field">
                            <option value="newest" @selected(($filters['sort'] ?? 'newest') === 'newest')>Newest</option>
                            <option value="deadline" @selected(($filters['sort'] ?? '') === 'deadline')>Deadline</option>
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit" class="qb-primary px-4">Apply</button>
                        <a href="{{ route('quests.index') }}" class="qb-secondary px-4">Reset</a>
                    </div>
                </form>
            </section>

            <section class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($quests as $quest)
                    <x-quest-card :quest="$quest" :difficulties="$difficulties" :statuses="$statuses" />
                @empty
                    <div class="rounded-lg border border-dashed border-border bg-panel/40 p-10 text-center md:col-span-2 xl:col-span-3">
                        <p class="font-display text-2xl font-bold text-white">Your quest board is empty.</p>
                        <p class="mt-2 text-sm text-slate-500">Begin your journey by creating your first quest.</p>
                        <a href="{{ route('quests.create') }}" class="qb-gold mt-6">Create First Quest</a>
                    </div>
                @endforelse
            </section>

            <div class="text-slate-300">
                {{ $quests->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
