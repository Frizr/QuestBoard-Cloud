<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">Quest Categories</p>
                <h1 class="mt-2 text-2xl font-black text-white sm:text-3xl">Organize your quest types</h1>
                <p class="mt-2 text-sm text-slate-400">Create categories such as Work, Study, Personal, Health, and Project.</p>
            </div>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center justify-center rounded-md bg-purple-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-purple-950/30 transition hover:-translate-y-0.5 hover:bg-purple-400">
                New Category
            </a>
        </div>
    </x-slot>

    <div class="px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-6 lg:grid-cols-[360px_1fr]">
            <section class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-5 shadow-xl shadow-purple-950/20">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-amber-300">Quick Add</p>
                <h2 class="mt-2 text-xl font-bold text-white">Create category</h2>

                <form method="POST" action="{{ route('categories.store') }}" class="mt-5 space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-300">Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" maxlength="100" required class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                        @error('name')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="color" class="block text-sm font-semibold text-slate-300">Color</label>
                        <input id="color" name="color" type="text" value="{{ old('color', '#7C3AED') }}" maxlength="30" class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                        @error('color')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full rounded-md bg-purple-500 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-purple-400">
                        Save Category
                    </button>
                </form>
            </section>

            <section class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-5 shadow-xl shadow-purple-950/20">
                @if (session('status'))
                    <div class="mb-5 rounded-md border border-emerald-300/30 bg-emerald-500/15 px-4 py-3 text-sm font-semibold text-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-amber-300">Category List</p>
                        <h2 class="mt-2 text-xl font-bold text-white">{{ $categories->count() }} categories</h2>
                    </div>
                </div>

                <div class="mt-5 grid gap-3 md:grid-cols-2">
                    @forelse ($categories as $category)
                        <article class="rounded-lg border border-white/10 bg-white/[0.04] p-4 transition hover:border-purple-300/30 hover:bg-white/[0.07]">
                            <div class="flex items-start justify-between gap-4">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-3">
                                        <span class="h-3 w-3 rounded-full" style="background-color: {{ $category->color ?: '#7C3AED' }}"></span>
                                        <h3 class="truncate font-bold text-white">{{ $category->name }}</h3>
                                    </div>
                                    <p class="mt-2 text-sm text-slate-400">{{ $category->quests_count }} quests</p>
                                </div>
                                <div class="flex shrink-0 items-center gap-2">
                                    <a href="{{ route('categories.edit', $category) }}" class="rounded-md border border-amber-300/30 px-3 py-1.5 text-xs font-bold text-amber-100 transition hover:bg-amber-300/10">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('categories.destroy', $category) }}" onsubmit="return confirm('Delete this category? Quests will become uncategorized.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-md border border-red-300/30 px-3 py-1.5 text-xs font-bold text-red-100 transition hover:bg-red-500/10">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-lg border border-dashed border-white/15 p-8 text-center text-sm text-slate-500 md:col-span-2">
                            No categories yet.
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
