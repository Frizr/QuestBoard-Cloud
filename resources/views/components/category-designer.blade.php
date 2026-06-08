@props(['category' => null])

@php
    $palette = [
        '#6D28D9' => 'Arcane Purple',
        '#8B5CF6' => 'Violet Glow',
        '#38BDF8' => 'Frost Blue',
        '#FBBF24' => 'Royal Gold',
        '#B45309' => 'Ember Bronze',
        '#DC2626' => 'Crimson Red',
        '#22C55E' => 'Success Green',
        '#14B8A6' => 'Aqua Rune',
    ];
    $emblems = [
        'shield' => 'Shield',
        'sword' => 'Sword',
        'book' => 'Book',
        'compass' => 'Compass',
        'hammer' => 'Hammer',
        'star' => 'Star',
        'crown' => 'Crown',
        'flame' => 'Flame',
    ];
    $currentColor = old('color', $category?->color ?: '#6D28D9');
    $currentEmblem = old('emblem', $category?->emblem ?: 'shield');
@endphp

<div x-data="{ color: @js($currentColor), emblem: @js($currentEmblem) }" class="space-y-5">
    <div>
        <label for="name" class="block text-sm font-bold tracking-wide text-slate-200">Category Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $category?->name) }}" maxlength="100" required placeholder="Example: Project, Study, Health" class="qb-field">
        @error('name')
            <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-5 md:grid-cols-[170px_1fr]">
        <div class="rounded-lg border border-border bg-obsidian/35 p-4 text-center">
            <div class="mx-auto grid h-24 w-24 place-items-center rounded-lg border shadow-lg" :style="`border-color: ${color}99; color: ${color}; background-color: ${color}22`">
                <template x-if="emblem === 'shield'"><span><x-guild-emblem type="shield" class="h-12 w-12" /></span></template>
                <template x-if="emblem === 'sword'"><span><x-guild-emblem type="sword" class="h-12 w-12" /></span></template>
                <template x-if="emblem === 'book'"><span><x-guild-emblem type="book" class="h-12 w-12" /></span></template>
                <template x-if="emblem === 'compass'"><span><x-guild-emblem type="compass" class="h-12 w-12" /></span></template>
                <template x-if="emblem === 'hammer'"><span><x-guild-emblem type="hammer" class="h-12 w-12" /></span></template>
                <template x-if="emblem === 'star'"><span><x-guild-emblem type="star" class="h-12 w-12" /></span></template>
                <template x-if="emblem === 'crown'"><span><x-guild-emblem type="crown" class="h-12 w-12" /></span></template>
                <template x-if="emblem === 'flame'"><span><x-guild-emblem type="flame" class="h-12 w-12" /></span></template>
            </div>
            <p class="mt-3 text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Live Preview</p>
        </div>

        <div class="space-y-5">
            <div>
                <label for="color" class="block text-sm font-bold tracking-wide text-slate-200">Guild Emblem Color</label>
                <div class="mt-2 flex items-center gap-3">
                    <input id="color" name="color" type="color" x-model="color" class="h-12 w-16 rounded-md border border-border bg-panel p-1">
                    <div>
                        <p class="text-sm font-semibold text-white" x-text="color"></p>
                        <p class="text-xs text-slate-500">Pick a color visually. No need to type color code.</p>
                    </div>
                </div>
                @error('color')
                    <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <p class="text-sm font-bold tracking-wide text-slate-200">Quick Colors</p>
                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach ($palette as $hex => $label)
                        <button type="button" @click="color = '{{ $hex }}'" class="group flex items-center gap-2 rounded-md border border-border bg-panel/70 px-3 py-2 text-xs font-bold text-slate-300 transition hover:border-violet/50 hover:text-white">
                            <span class="h-5 w-5 rounded-full border border-white/20" style="background-color: {{ $hex }}"></span>
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div>
        <p class="text-sm font-bold tracking-wide text-slate-200">Center Guild Logo</p>
        <p class="mt-1 text-xs text-slate-500">Choose the emblem that appears in the middle of the category badge.</p>
        <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-4">
            @foreach ($emblems as $value => $label)
                <label :class="emblem === '{{ $value }}' ? 'border-royal bg-royal/10 text-royal shadow-gold' : 'border-border bg-panel/60 text-slate-300 hover:border-violet/50 hover:text-white'" class="cursor-pointer rounded-lg border p-3 text-center transition">
                    <input type="radio" name="emblem" value="{{ $value }}" x-model="emblem" class="sr-only">
                    <x-guild-emblem :type="$value" class="mx-auto h-7 w-7" />
                    <span class="mt-2 block text-xs font-bold">{{ $label }}</span>
                </label>
            @endforeach
        </div>
        @error('emblem')
            <p class="mt-2 text-sm font-semibold text-red-300">{{ $message }}</p>
        @enderror
    </div>
</div>
