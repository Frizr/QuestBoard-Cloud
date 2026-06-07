<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">Edit Quest</p>
            <h1 class="mt-2 text-2xl font-black text-white sm:text-3xl">{{ $quest->title }}</h1>
        </div>
    </x-slot>

    <div class="px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl rounded-lg border border-white/10 bg-[#1E293B]/70 p-6 shadow-xl shadow-purple-950/20">
            <form method="POST" action="{{ route('quests.update', $quest) }}" class="space-y-5">
                @csrf
                @method('PATCH')
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-300">Title</label>
                    <input id="title" name="title" type="text" value="{{ old('title', $quest->title) }}" maxlength="150" required class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                    @error('title') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-300">Description</label>
                    <textarea id="description" name="description" rows="5" class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">{{ old('description', $quest->description) }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-slate-300">Category</label>
                        <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                            <option value="">Uncategorized</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $quest->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="difficulty" class="block text-sm font-semibold text-slate-300">Difficulty</label>
                        <select id="difficulty" name="difficulty" required class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                            @foreach ($difficulties as $value => $label)
                                <option value="{{ $value }}" @selected(old('difficulty', $quest->difficulty) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('difficulty') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-300">Status</label>
                        <select id="status" name="status" required class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" @selected(old('status', $quest->status) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="deadline" class="block text-sm font-semibold text-slate-300">Deadline</label>
                        <input id="deadline" name="deadline" type="datetime-local" value="{{ old('deadline', optional($quest->deadline)->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                        @error('deadline') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="rounded-md bg-purple-500 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-purple-400">Update Quest</button>
                    <a href="{{ route('quests.show', $quest) }}" class="rounded-md border border-white/10 px-5 py-2.5 text-sm font-bold text-slate-200 transition hover:bg-white/10">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
