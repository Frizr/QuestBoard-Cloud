<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="qb-section-kicker">Quest Contract</p>
                <h1 class="mt-2 qb-heading text-3xl sm:text-4xl">Create New Quest</h1>
                <p class="mt-2 text-base text-slate-400">Write a new mission for your journey.</p>
            </div>
            <a href="{{ route('quests.index') }}" class="qb-secondary">Abandon Contract</a>
        </div>
    </x-slot>

    <div class="qb-page-shell">
        <div class="mx-auto max-w-4xl">
            <section class="qb-panel p-6 sm:p-8">
                <form method="POST" action="{{ route('quests.store') }}" class="space-y-6">
                    @csrf

                    <div class="text-center">
                        <p class="qb-section-kicker">Guild Board Posting</p>
                        <h2 class="mt-2 font-display text-3xl font-bold text-white">Draft Mission Terms</h2>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-bold tracking-wide text-slate-200">Quest Title</label>
                        <input id="title" name="title" type="text" value="{{ old('title') }}" maxlength="150" required placeholder="e.g. Deploy QuestBoard to production" class="qb-field">
                        @error('title') <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-bold tracking-wide text-slate-200">Detailed Briefing</label>
                        <textarea id="description" name="description" rows="6" placeholder="Describe objectives, expected outcome, and useful notes..." class="qb-field">{{ old('description') }}</textarea>
                        @error('description') <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label for="category_id" class="block text-sm font-bold tracking-wide text-slate-200">Guild Division</label>
                            <select id="category_id" name="category_id" class="qb-field">
                                <option value="">Uncategorized</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="difficulty" class="block text-sm font-bold tracking-wide text-slate-200">Threat Level</label>
                            <select id="difficulty" name="difficulty" required class="qb-field">
                                @foreach ($difficulties as $value => $label)
                                    <option value="{{ $value }}" @selected(old('difficulty', 'normal') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('difficulty') <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-bold tracking-wide text-slate-200">Initial Status</label>
                            <select id="status" name="status" required class="qb-field">
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}" @selected(old('status', 'pending') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status') <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="deadline" class="block text-sm font-bold tracking-wide text-slate-200">Completion Deadline</label>
                            <input id="deadline" name="deadline" type="datetime-local" value="{{ old('deadline') }}" class="qb-field">
                            @error('deadline') <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-border pt-6 sm:flex-row sm:justify-end">
                        <a href="{{ route('quests.index') }}" class="qb-secondary">Cancel</a>
                        <button type="submit" class="qb-primary">Post to Guild Board</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
