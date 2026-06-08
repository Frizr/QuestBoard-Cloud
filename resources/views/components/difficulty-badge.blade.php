@props(['value', 'labels' => []])

@php
    $classes = [
        'easy' => 'border-emerald-400/35 bg-emerald-500/15 text-emerald-100 shadow-emerald-500/10',
        'normal' => 'border-frost/40 bg-frost/15 text-sky-100 shadow-frost/10',
        'hard' => 'border-orange-400/40 bg-orange-500/15 text-orange-100 shadow-orange-500/10',
        'epic' => 'border-violet/50 bg-violet/20 text-violet-100 shadow-violet/20',
        'boss' => 'border-royal/60 bg-crimson/20 text-royal shadow-royal/25',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 rounded-md border px-2.5 py-1 text-xs font-extrabold shadow-lg '.($classes[$value] ?? 'border-border bg-slate-500/10 text-slate-200')]) }}>
    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
    {{ $labels[$value] ?? Illuminate\Support\Str::headline($value) }}
</span>
