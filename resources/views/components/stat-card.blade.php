@props(['label', 'value', 'hint' => null, 'tone' => 'text-slate-50', 'symbol' => '+'])

<article {{ $attributes->merge(['class' => 'qb-panel-soft relative overflow-hidden p-5 transition hover:-translate-y-1 hover:border-violet/50 hover:shadow-arcane']) }}>
    <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-violet/10 blur-2xl"></div>
    <div class="relative flex items-start justify-between gap-4">
        <div>
            <p class="text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">{{ $label }}</p>
            <p class="mt-4 font-display text-3xl font-bold {{ $tone }}">{{ $value }}</p>
            @if ($hint)
                <p class="mt-2 text-sm text-slate-500">{{ $hint }}</p>
            @endif
        </div>
        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-md border border-border bg-panel text-sm font-black text-royal">
            {{ $symbol }}
        </span>
    </div>
</article>
