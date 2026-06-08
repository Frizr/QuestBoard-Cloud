@props(['type' => 'shield'])

<svg {{ $attributes->merge(['class' => 'h-6 w-6']) }} viewBox="0 0 24 24" fill="none" aria-hidden="true">
    @switch($type)
        @case('sword')
            <path d="M14.5 4 20 2l-2 5.5L8 17.5 6.5 16 16.5 6Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
            <path d="m6 15 3 3M4 20l4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            @break
        @case('book')
            <path d="M5 5.5c2.7-.8 4.8-.4 7 1.2 2.2-1.6 4.3-2 7-1.2v12.7c-2.7-.8-4.8-.4-7 1.2-2.2-1.6-4.3-2-7-1.2V5.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
            <path d="M12 6.7v12.7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            @break
        @case('compass')
            <circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.8"/>
            <path d="m15.5 8.5-2 5-5 2 2-5 5-2Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
            @break
        @case('hammer')
            <path d="m14 4 6 6-2 2-6-6 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
            <path d="M12 8 4 16.5 7.5 20 16 12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            @break
        @case('star')
            <path d="m12 3 2.3 5 5.4.6-4 3.7 1.1 5.4L12 15l-4.8 2.7 1.1-5.4-4-3.7 5.4-.6L12 3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
            @break
        @case('crown')
            <path d="M4 8.5 8.5 13 12 6l3.5 7L20 8.5V18H4V8.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
            <path d="M4 18h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            @break
        @case('flame')
            <path d="M13 3c.6 4.1 5 5.2 5 10a6 6 0 1 1-12 0c0-2.6 1.5-4.6 3.4-6.4-.2 2.2.8 3.8 2.1 4.7.9-1.9 1.3-4.5 1.5-8.3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
            @break
        @default
            <path d="M12 3 5 6v5.2c0 4.7 3 7.8 7 9.8 4-2 7-5.1 7-9.8V6l-7-3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
            <path d="M12 7v9M8.5 10.5h7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
    @endswitch
</svg>
