@props(['user' => null, 'name' => null, 'size' => 'md'])

@php
    $sizes = [
        'sm' => 'h-10 w-10',
        'md' => 'h-20 w-20',
        'lg' => 'h-28 w-28',
        'xl' => 'h-36 w-36',
    ];
    $badges = [
        'sm' => 'h-5 min-w-5 px-1 text-[9px]',
        'md' => 'h-7 min-w-7 px-1.5 text-[10px]',
        'lg' => 'h-8 min-w-8 px-1.5 text-[11px]',
        'xl' => 'h-9 min-w-9 px-2 text-xs',
    ];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $badgeClass = $badges[$size] ?? $badges['md'];
    $displayName = $name ?? $user?->name;
    $template = \App\Support\AvatarTemplates::normalize($user?->avatar_template);
    $imageUrl = $user?->avatar_path ? asset('storage/'.ltrim($user->avatar_path, '/')) : null;
    $level = max(1, (int) ($user?->level ?? 1));
@endphp

<div {{ $attributes->merge(['class' => 'relative inline-flex shrink-0']) }}>
    @if ($imageUrl)
        <img
            src="{{ $imageUrl }}"
            alt="{{ $displayName ? $displayName.' profile picture' : 'Adventurer profile picture' }}"
            class="{{ $sizeClass }} rounded-full border border-royal/70 bg-obsidian object-cover shadow-gold ring-2 ring-black/30"
        >
    @else
        <x-avatar-portrait
            :template="$template"
            class="{{ $sizeClass }} rounded-full border border-royal/70 object-cover shadow-gold ring-2 ring-black/30"
        />
    @endif

    <span class="{{ $badgeClass }} absolute -bottom-1 -right-1 grid place-items-center rounded-full border border-royal/60 bg-card font-black leading-none text-royal shadow-gold" title="Level {{ $level }}">
        {{ $level }}
    </span>
</div>
