<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="qb-section-kicker">Guild Division</p>
                <h1 class="mt-2 qb-heading text-3xl sm:text-4xl">Create Category</h1>
                <p class="mt-2 text-base text-slate-400">Add a new section for your quest board.</p>
            </div>
            <a href="{{ route('categories.index') }}" class="qb-secondary">Back to Categories</a>
        </div>
    </x-slot>

    <div class="qb-page-shell">
        <div class="mx-auto max-w-xl">
            <section class="qb-panel p-6 sm:p-8">
                <form method="POST" action="{{ route('categories.store') }}" class="space-y-5">
                    @csrf
                    <x-category-designer />

                    <div class="flex flex-col-reverse gap-3 border-t border-border pt-5 sm:flex-row sm:justify-end">
                        <a href="{{ route('categories.index') }}" class="qb-secondary">Cancel</a>
                        <button type="submit" class="qb-primary">Create Category</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
