@props(['value', 'labels' => [], 'overdue' => false])

@php
    $classes = [
        'pending' => 'border-royal/35 bg-royal/10 text-amber-100',
        'in_progress' => 'border-frost/40 bg-frost/15 text-sky-100',
        'completed' => 'border-emerald-400/35 bg-emerald-500/15 text-emerald-100',
    ];
@endphp

@if ($overdue)
    <span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 rounded-md border border-crimson/50 bg-crimson/20 px-2.5 py-1 text-xs font-extrabold text-red-100 shadow-lg shadow-crimson/20']) }}>
        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
        Overdue
    </span>
@else
    <span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 rounded-md border px-2.5 py-1 text-xs font-extrabold '.($classes[$value] ?? 'border-border bg-slate-500/10 text-slate-200')]) }}>
        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
        {{ $labels[$value] ?? Illuminate\Support\Str::headline($value) }}
    </span>
@endif
