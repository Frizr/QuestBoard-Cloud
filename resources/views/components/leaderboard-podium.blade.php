@props(['leader', 'rank'])

@php
    $rankStyles = [
        1 => 'border-royal/70 bg-gradient-to-br from-royal/15 via-card to-bronze/10 text-royal lg:-mt-10',
        2 => 'border-slate-300/35 bg-card/85 text-slate-200',
        3 => 'border-bronze/50 bg-card/85 text-orange-200',
    ];
    $titles = [
        1 => 'Gold Champion',
        2 => 'Silver Elite',
        3 => 'Bronze Hero',
    ];
@endphp

<article {{ $attributes->merge(['class' => 'rounded-lg border p-6 text-center shadow-2xl shadow-black/30 '.($rankStyles[$rank] ?? 'border-border bg-card/85 text-slate-200')]) }}>
    @if ($leader)
        <p class="font-display text-4xl font-bold">#{{ $rank }}</p>
        <x-adventurer-avatar :user="$leader" size="md" class="mx-auto mt-5" />
        <h3 class="mt-5 break-words font-display text-2xl font-bold text-slate-50">{{ $leader->name }}</h3>
        <p class="mt-1 text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">{{ $titles[$rank] }}</p>
        <div class="mt-5 grid grid-cols-3 gap-3 rounded-md border border-border/70 bg-obsidian/35 p-4">
            <div>
                <p class="text-xs text-slate-500">Level</p>
                <p class="mt-1 font-display text-2xl font-bold text-frost">{{ $leader->level }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500">EXP</p>
                <p class="mt-1 font-display text-xl font-bold text-royal">{{ number_format($leader->total_exp) }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500">Done</p>
                <p class="mt-1 font-display text-xl font-bold text-emerald-200">{{ $leader->completed_quests_count }}</p>
            </div>
        </div>
    @else
        <p class="font-display text-3xl font-bold text-slate-600">#{{ $rank }}</p>
        <div class="mx-auto mt-5 grid h-20 w-20 place-items-center rounded-full border border-dashed border-border text-slate-600">
            -
        </div>
        <p class="mt-5 text-sm text-slate-500">Awaiting adventurer</p>
    @endif
</article>
