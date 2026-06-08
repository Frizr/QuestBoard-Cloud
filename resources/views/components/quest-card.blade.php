@props(['quest', 'difficulties' => [], 'statuses' => [], 'actions' => true, 'compact' => false])

@php
    $isOverdue = $quest->isOverdue();
@endphp

<article {{ $attributes->merge(['class' => 'group relative overflow-hidden rounded-lg border bg-card/85 p-5 shadow-xl shadow-black/20 transition hover:-translate-y-1 '.($isOverdue ? 'border-crimson/45 shadow-crimson/10' : 'border-border/85 hover:border-violet/50 hover:shadow-arcane')]) }}>
    <div class="absolute inset-y-0 left-0 w-1 bg-gradient-to-b {{ $isOverdue ? 'from-crimson to-royal' : 'from-violet to-frost' }} opacity-80"></div>

    <div class="flex flex-wrap gap-2">
        @if ($isOverdue)
            <x-status-badge value="overdue" overdue />
        @endif
        <x-difficulty-badge :value="$quest->difficulty" :labels="$difficulties" />
        <x-status-badge :value="$quest->status" :labels="$statuses" />
    </div>

    <h2 class="mt-4 break-words font-display text-xl font-bold text-slate-50 transition group-hover:text-violet-100">
        {{ $quest->title }}
    </h2>

    @unless ($compact)
        <p class="mt-3 max-h-[4.5rem] overflow-hidden text-sm leading-6 text-slate-400">
            {{ $quest->description ?: 'No briefing provided.' }}
        </p>
    @endunless

    <div class="mt-5 grid grid-cols-2 gap-3 text-sm">
        <div class="rounded-md border border-white/10 bg-obsidian/35 p-3">
            <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Guild Division</p>
            <p class="mt-1 truncate font-semibold text-slate-200">{{ $quest->category?->name ?? 'Uncategorized' }}</p>
        </div>
        <div class="rounded-md border border-royal/20 bg-royal/10 p-3">
            <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Reward</p>
            <p class="mt-1 font-black text-royal">{{ $quest->reward_exp }} EXP</p>
        </div>
    </div>

    <div class="mt-5 flex flex-wrap items-center justify-between gap-3 border-t border-border/70 pt-4">
        <p class="text-xs font-bold {{ $isOverdue ? 'text-red-200' : 'text-slate-500' }}">
            {{ $quest->deadline ? 'Due '.$quest->deadline->format('M d, Y H:i') : 'No deadline' }}
        </p>

        @if ($actions)
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('quests.show', $quest) }}" class="rounded-md border border-frost/30 px-3 py-1.5 text-xs font-bold text-sky-100 transition hover:bg-frost/10">View</a>
                <a href="{{ route('quests.edit', $quest) }}" class="rounded-md border border-royal/30 px-3 py-1.5 text-xs font-bold text-amber-100 transition hover:bg-royal/10">Edit</a>
                <form method="POST" action="{{ route('quests.destroy', $quest) }}" onsubmit="return confirm('Delete this quest?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-md border border-crimson/40 px-3 py-1.5 text-xs font-bold text-red-100 transition hover:bg-crimson/10">Delete</button>
                </form>
            </div>
        @endif
    </div>
</article>
