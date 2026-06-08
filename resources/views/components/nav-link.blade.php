@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-md border border-royal/30 bg-royal/10 px-3 py-2 text-sm font-extrabold leading-5 text-royal shadow-gold focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center rounded-md border border-transparent px-3 py-2 text-sm font-bold leading-5 text-slate-400 hover:border-violet/35 hover:bg-white/5 hover:text-white focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
