<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="qb-section-kicker">Guild Archive</p>
                <h1 class="mt-2 qb-heading text-3xl sm:text-4xl">Guild Categories</h1>
                <p class="mt-2 text-base text-slate-400">Organize your quests into meaningful guild sections.</p>
            </div>
            <a href="{{ route('categories.create') }}" class="qb-primary">
                <span class="text-lg leading-none">+</span>
                Add New Category
            </a>
        </div>
    </x-slot>

    <div class="qb-page-shell">
        <div class="grid gap-6 lg:grid-cols-[360px_1fr]">
            <section class="qb-panel-soft p-5">
                <p class="qb-section-kicker">Quick Add</p>
                <h2 class="mt-2 font-display text-2xl font-bold text-white">Create Division</h2>

                <form method="POST" action="{{ route('categories.store') }}" class="mt-6 space-y-5">
                    @csrf
                    <x-category-designer />
                    <button type="submit" class="qb-primary w-full">Save Category</button>
                </form>
            </section>

            <section class="qb-panel-soft p-5">
                @if (session('status'))
                    <div class="mb-5 rounded-md border border-emerald-400/30 bg-emerald-500/15 px-4 py-3 text-sm font-semibold text-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="qb-section-kicker">Division Roster</p>
                        <h2 class="mt-2 font-display text-2xl font-bold text-white">{{ $categories->count() }} categories</h2>
                    </div>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($categories as $category)
                        <x-category-card :category="$category" />
                    @empty
                        <div class="rounded-lg border border-dashed border-border bg-panel/40 p-10 text-center text-slate-500 md:col-span-2 xl:col-span-3">
                            <p class="font-display text-2xl font-bold text-white">Your guild has no categories yet.</p>
                            <p class="mt-2 text-sm">Create your first category to organize your quests.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
