@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full border-l-4 border-royal bg-royal/10 py-3 pe-4 ps-4 text-start text-base font-extrabold text-royal focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full border-l-4 border-transparent py-3 pe-4 ps-4 text-start text-base font-bold text-slate-400 hover:border-violet hover:bg-white/5 hover:text-white focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
