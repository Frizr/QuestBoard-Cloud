@props(['template' => 'shadow-mage'])

@php
    $templates = \App\Support\AvatarTemplates::all();
    $key = \App\Support\AvatarTemplates::normalize($template);
    $meta = $templates[$key];
    $gradientId = 'avatar_'.str_replace('.', '', uniqid('', true));
@endphp

<svg
    {{ $attributes->merge(['class' => 'overflow-hidden rounded-full']) }}
    viewBox="0 0 128 128"
    fill="none"
    role="img"
    aria-label="{{ $meta['name'] }} portrait"
    xmlns="http://www.w3.org/2000/svg"
>
    <defs>
        <radialGradient id="{{ $gradientId }}_bg" cx="50%" cy="34%" r="72%">
            <stop offset="0%" stop-color="{{ $meta['accent'] }}" stop-opacity="0.45"/>
            <stop offset="46%" stop-color="#172033"/>
            <stop offset="100%" stop-color="#050816"/>
        </radialGradient>
        <linearGradient id="{{ $gradientId }}_robe" x1="29" y1="67" x2="99" y2="122" gradientUnits="userSpaceOnUse">
            <stop stop-color="{{ $meta['robe'] }}"/>
            <stop offset="1" stop-color="#0B1020"/>
        </linearGradient>
        <filter id="{{ $gradientId }}_glow" x="-40%" y="-40%" width="180%" height="180%">
            <feGaussianBlur stdDeviation="3" result="blur"/>
            <feMerge>
                <feMergeNode in="blur"/>
                <feMergeNode in="SourceGraphic"/>
            </feMerge>
        </filter>
    </defs>

    <rect width="128" height="128" rx="64" fill="url(#{{ $gradientId }}_bg)"/>
    <path d="M18 103c9-23 24-35 46-35s37 12 46 35v25H18v-25Z" fill="url(#{{ $gradientId }}_robe)"/>
    <path d="M31 108c11-14 22-21 33-21s22 7 33 21" stroke="{{ $meta['accent'] }}" stroke-opacity="0.45" stroke-width="3" stroke-linecap="round"/>

    @if ($key === 'iron-paladin')
        <path d="M35 55c0-22 12-36 29-36s29 14 29 36v18c-7 9-16 14-29 14S42 82 35 73V55Z" fill="#CBD5E1" opacity="0.92"/>
        <path d="M37 55c8-8 17-12 27-12s19 4 27 12" stroke="#334155" stroke-width="5" stroke-linecap="round"/>
        <path d="M47 60h34M55 70h18" stroke="#0B1020" stroke-width="5" stroke-linecap="round"/>
        <path d="M64 20v60" stroke="{{ $meta['accent'] }}" stroke-width="3" stroke-linecap="round"/>
    @else
        <path d="M33 64c2-27 14-43 31-43s29 16 31 43c-9-8-19-12-31-12S42 56 33 64Z" fill="{{ $meta['robe'] }}"/>
        <path d="M42 59c2-17 10-28 22-28s20 11 22 28c-7-4-14-6-22-6s-15 2-22 6Z" fill="#0B1020" opacity="0.52"/>
        <ellipse cx="64" cy="61" rx="22" ry="26" fill="{{ $meta['skin'] }}"/>
        <path d="M43 64c5-8 12-12 21-12s16 4 21 12" stroke="#050816" stroke-opacity="0.25" stroke-width="5" stroke-linecap="round"/>
        <circle cx="55" cy="64" r="2.5" fill="#050816"/>
        <circle cx="73" cy="64" r="2.5" fill="#050816"/>
        <path d="M57 76c4 3 10 3 14 0" stroke="#050816" stroke-opacity="0.6" stroke-width="3" stroke-linecap="round"/>
    @endif

    @switch($meta['mark'])
        @case('shield')
            <path d="M64 11 51 17v10c0 10 5 17 13 21 8-4 13-11 13-21V17l-13-6Z" fill="{{ $meta['accent'] }}" filter="url(#{{ $gradientId }}_glow)" opacity="0.9"/>
            <path d="M64 18v18M57 26h14" stroke="#1A1206" stroke-width="2.5" stroke-linecap="round"/>
            @break
        @case('leaf')
            <path d="M80 18c-20 2-30 12-31 29 17-1 27-11 31-29Z" fill="{{ $meta['accent'] }}" filter="url(#{{ $gradientId }}_glow)" opacity="0.88"/>
            <path d="M52 45c8-9 16-16 27-25" stroke="#052E16" stroke-width="2.5" stroke-linecap="round"/>
            @break
        @case('blade')
            <path d="M75 14 86 10 82 21 52 51l-7-7 30-30Z" fill="{{ $meta['accent'] }}" filter="url(#{{ $gradientId }}_glow)"/>
            <path d="m47 46 7 7" stroke="#1A1206" stroke-width="2.5" stroke-linecap="round"/>
            @break
        @case('star')
            <path d="m64 13 5 11 12 1-9 8 3 12-11-6-11 6 3-12-9-8 12-1 5-11Z" fill="{{ $meta['accent'] }}" filter="url(#{{ $gradientId }}_glow)" opacity="0.92"/>
            @break
        @case('crown')
            <path d="M47 35 54 21l10 16 10-16 7 14v9H47v-9Z" fill="{{ $meta['accent'] }}" filter="url(#{{ $gradientId }}_glow)" opacity="0.92"/>
            <path d="M47 44h34" stroke="#1A1206" stroke-width="2.5" stroke-linecap="round"/>
            @break
        @default
            <circle cx="64" cy="26" r="12" stroke="{{ $meta['accent'] }}" stroke-width="4" filter="url(#{{ $gradientId }}_glow)"/>
            <path d="M64 14v24M52 26h24M56 18l16 16M72 18 56 34" stroke="{{ $meta['accent'] }}" stroke-width="2.5" stroke-linecap="round"/>
    @endswitch

    <circle cx="64" cy="64" r="61" stroke="{{ $meta['accent'] }}" stroke-opacity="0.45" stroke-width="3"/>
</svg>
