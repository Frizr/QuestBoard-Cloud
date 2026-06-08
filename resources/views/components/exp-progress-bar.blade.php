@props(['progress' => 0, 'current' => null, 'next' => null])

@php
    $safeProgress = min(100, max(0, (int) $progress));
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    <div class="flex items-center justify-between text-xs font-bold uppercase tracking-[0.14em] text-slate-400">
        <span>Progress to next level</span>
        <span class="text-royal">{{ $safeProgress }}%</span>
    </div>
    <div class="mt-3 h-3 overflow-hidden rounded-full border border-border bg-obsidian/70 shadow-inner shadow-black">
        <div class="h-full rounded-full bg-gradient-to-r from-frost via-violet to-royal shadow-[0_0_22px_rgba(139,92,246,0.55)]" style="width: {{ $safeProgress }}%"></div>
    </div>
    @if (! is_null($current) && ! is_null($next))
        <div class="mt-2 flex justify-between text-xs font-semibold text-slate-500">
            <span>{{ $current }} EXP</span>
            <span>{{ $next }} EXP</span>
        </div>
    @endif
</div>
