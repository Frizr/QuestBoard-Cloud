@props(['template' => \App\Support\AvatarTemplates::DEFAULT])

@php
    $key = \App\Support\AvatarTemplates::normalize($template);
    $meta = \App\Support\AvatarTemplates::find($key);
@endphp

<img
    src="{{ asset($meta['asset']) }}"
    alt="{{ $meta['name'] }} portrait"
    data-avatar-template="{{ $key }}"
    {{ $attributes->merge(['class' => 'overflow-hidden rounded-full bg-obsidian object-cover']) }}
>
