@props(['category'])

@php
    $color = $category->color ?: '#6D28D9';
@endphp

<article {{ $attributes->merge(['class' => 'qb-panel-soft group p-5 transition hover:-translate-y-1 hover:border-violet/50 hover:shadow-arcane']) }}>
    <div class="flex items-start justify-between gap-4">
        <div class="flex min-w-0 items-start gap-4">
            <span class="grid h-14 w-14 shrink-0 place-items-center rounded-lg border shadow-lg" style="border-color: {{ $color }}66; color: {{ $color }}; background-color: {{ $color }}22;">
                <x-guild-emblem :type="$category->emblem ?? 'shield'" class="h-8 w-8" />
            </span>
            <div class="min-w-0">
                <h3 class="break-words font-display text-xl font-bold text-white">{{ $category->name }}</h3>
                <div class="mt-3 flex flex-wrap items-center gap-2 text-sm text-slate-400">
                    <span class="h-3 w-3 rounded-full ring-2 ring-white/10" style="background-color: {{ $color }}"></span>
                    <span>{{ isset($category->quests_count) ? $category->quests_count.' quests' : 'Guild division' }}</span>
                    <span class="rounded-full border border-border px-2 py-0.5 text-xs">{{ Illuminate\Support\Str::headline($category->emblem ?? 'shield') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 flex flex-wrap gap-2 border-t border-border/70 pt-4">
        <a href="{{ route('categories.edit', $category) }}" class="rounded-md border border-royal/30 px-3 py-1.5 text-xs font-bold text-amber-100 transition hover:bg-royal/10">
            Edit
        </a>
        <form method="POST" action="{{ route('categories.destroy', $category) }}" onsubmit="return confirm('Delete this category? Quests will become uncategorized.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="rounded-md border border-crimson/40 px-3 py-1.5 text-xs font-bold text-red-100 transition hover:bg-crimson/10">
                Delete
            </button>
        </form>
    </div>
</article>
