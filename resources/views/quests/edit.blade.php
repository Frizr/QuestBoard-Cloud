<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="qb-section-kicker">Quest Contract</p>
                <h1 class="mt-2 qb-heading text-3xl sm:text-4xl">Edit Quest</h1>
                <p class="mt-2 max-w-2xl text-base text-slate-400">Update your mission details without changing the route or backend flow.</p>
            </div>
            <a href="{{ route('quests.show', $quest) }}" class="qb-secondary">Back to Briefing</a>
        </div>
    </x-slot>

    <div class="qb-page-shell">
        <div class="mx-auto max-w-4xl">
            <section class="qb-panel p-6 sm:p-8">
                <form method="POST" action="{{ route('quests.update', $quest) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="text-center">
                        <p class="qb-section-kicker">Guild Board Revision</p>
                        <h2 class="mt-2 break-words font-display text-3xl font-bold text-white">{{ $quest->title }}</h2>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-bold tracking-wide text-slate-200">Quest Title</label>
                        <input id="title" name="title" type="text" value="{{ old('title', $quest->title) }}" maxlength="150" required class="qb-field">
                        @error('title') <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-bold tracking-wide text-slate-200">Detailed Briefing</label>
                        <textarea id="description" name="description" rows="6" class="qb-field">{{ old('description', $quest->description) }}</textarea>
                        @error('description') <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label for="category_id" class="block text-sm font-bold tracking-wide text-slate-200">Guild Division</label>
                            <select id="category_id" name="category_id" class="qb-field">
                                <option value="">Uncategorized</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $quest->category_id) == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="difficulty" class="block text-sm font-bold tracking-wide text-slate-200">Threat Level</label>
                            <select id="difficulty" name="difficulty" required class="qb-field">
                                @foreach ($difficulties as $value => $label)
                                    <option value="{{ $value }}" @selected(old('difficulty', $quest->difficulty) === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('difficulty') <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-bold tracking-wide text-slate-200">Current Status</label>
                            <select id="status" name="status" required class="qb-field">
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}" @selected(old('status', $quest->status) === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status') <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="deadline" class="block text-sm font-bold tracking-wide text-slate-200">Completion Deadline</label>
                            <input id="deadline" name="deadline" type="datetime-local" value="{{ old('deadline', optional($quest->deadline)->format('Y-m-d\TH:i')) }}" class="qb-field">
                            @error('deadline') <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-border pt-6 sm:flex-row sm:justify-end">
                        <a href="{{ route('quests.show', $quest) }}" class="qb-secondary">Cancel</a>
                        <button type="submit" class="qb-primary">Update Quest</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
