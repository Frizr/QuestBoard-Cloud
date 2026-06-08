@props(['user' => null, 'name' => null, 'size' => 'md'])

@php
    $sizes = [
        'sm' => 'h-10 w-10',
        'md' => 'h-20 w-20',
        'lg' => 'h-28 w-28',
        'xl' => 'h-36 w-36',
    ];
    $badges = [
        'sm' => 'h-5 w-5 text-[8px]',
        'md' => 'h-7 w-7 text-[10px]',
        'lg' => 'h-8 w-8 text-[11px]',
        'xl' => 'h-9 w-9 text-xs',
    ];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $badgeClass = $badges[$size] ?? $badges['md'];
    $displayName = $name ?? $user?->name;
    $template = \App\Support\AvatarTemplates::normalize($user?->avatar_template);
    $imageUrl = $user?->avatar_path ? asset('storage/'.ltrim($user->avatar_path, '/')) : null;
@endphp

<div {{ $attributes->merge(['class' => 'relative inline-flex shrink-0']) }}>
    @if ($imageUrl)
        <img
            src="{{ $imageUrl }}"
            alt="{{ $displayName ? $displayName.' profile picture' : 'Adventurer profile picture' }}"
            class="{{ $sizeClass }} rounded-full border border-royal/70 object-cover shadow-gold"
        >
    @else
        <x-avatar-portrait
            :template="$template"
            class="{{ $sizeClass }} rounded-full border border-royal/70 object-cover shadow-gold"
        />
    @endif

    <span class="{{ $badgeClass }} absolute -bottom-1 -right-1 grid place-items-center rounded-full border border-border bg-card font-black text-royal">
        LV
    </span>
</div>
