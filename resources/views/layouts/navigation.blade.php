@php
    $navItems = [
        ['label' => 'Guild Hall', 'icon' => 'crown', 'route' => 'dashboard', 'href' => route('dashboard'), 'active' => request()->routeIs('dashboard')],
        ['label' => 'Quest Log', 'icon' => 'sword', 'route' => 'quests.index', 'href' => route('quests.index'), 'active' => request()->routeIs('quests.*')],
        ['label' => 'Guild Categories', 'icon' => 'book', 'route' => 'categories.index', 'href' => route('categories.index'), 'active' => request()->routeIs('categories.*')],
        ['label' => 'Hall of Heroes', 'icon' => 'star', 'route' => 'leaderboard', 'href' => route('leaderboard'), 'active' => request()->routeIs('leaderboard')],
    ];
@endphp

<nav x-data="{ open: false }">
    <aside class="fixed inset-y-0 left-0 z-40 hidden w-72 border-r border-border/80 bg-[#15111d]/95 shadow-2xl shadow-black/50 backdrop-blur-xl md:flex md:flex-col">
        <div class="px-6 py-8 text-center">
            <a href="{{ route('dashboard') }}" class="inline-flex flex-col items-center">
                <x-adventurer-avatar :user="Auth::user()" size="md" />
                <span class="mt-4 font-display text-2xl font-bold text-royal qb-gold-glow">QuestBoard</span>
            </a>
            <p class="mt-4 font-display text-xl font-bold text-white">{{ Auth::user()->name }}</p>
            <p class="mt-1 text-sm font-bold text-slate-400">Level {{ Auth::user()->level ?? 1 }} Adventurer</p>
        </div>

        <div class="px-5">
            <a href="{{ route('quests.create') }}" class="qb-primary w-full">
                <span class="text-lg leading-none">+</span>
                Post Quest
            </a>
        </div>

        <div class="mt-8 flex-1 space-y-1">
            <p class="px-6 pb-2 text-xs font-extrabold uppercase tracking-[0.18em] text-slate-600">Guild Menu</p>
            @foreach ($navItems as $item)
                <a href="{{ $item['href'] }}" class="{{ $item['active'] ? 'border-l-4 border-royal bg-royal/10 text-royal shadow-gold' : 'border-l-4 border-transparent text-slate-400 hover:border-violet hover:bg-white/5 hover:text-white' }} flex items-center gap-3 px-6 py-4 text-sm font-extrabold transition">
                    <span class="grid h-8 w-8 place-items-center rounded-md border border-current/25">
                        <x-guild-emblem :type="$item['icon']" class="h-4 w-4" />
                    </span>
                    {{ $item['label'] }}
                </a>
            @endforeach
            <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'border-l-4 border-royal bg-royal/10 text-royal shadow-gold' : 'border-l-4 border-transparent text-slate-400 hover:border-violet hover:bg-white/5 hover:text-white' }} flex items-center gap-3 px-6 py-4 text-sm font-extrabold transition">
                <span class="grid h-8 w-8 place-items-center rounded-md border border-current/25">
                    <x-guild-emblem type="shield" class="h-4 w-4" />
                </span>
                Adventurer Profile
            </a>
        </div>

        <div class="border-t border-border/70 p-5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full rounded-md border border-border bg-panel/70 px-4 py-3 text-left text-sm font-bold text-slate-300 transition hover:border-crimson/50 hover:bg-crimson/10 hover:text-red-100">
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <div class="sticky top-0 z-40 border-b border-border/70 bg-panel/90 backdrop-blur-xl md:hidden">
        <div class="flex h-16 items-center justify-between px-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <x-adventurer-avatar :user="Auth::user()" size="sm" />
                <span class="font-display text-xl font-bold text-white">QuestBoard</span>
            </a>

            <button @click="open = ! open" class="rounded-md border border-border bg-surface/60 px-3 py-2 text-sm font-bold text-slate-200">
                Menu
            </button>
        </div>

        <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-border/70 bg-card/95 pb-4">
            <div class="space-y-1 pt-3">
                @foreach ($navItems as $item)
                    <x-responsive-nav-link :href="$item['href']" :active="$item['active']">
                        {{ $item['label'] }}
                    </x-responsive-nav-link>
                @endforeach
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    Adventurer Profile
                </x-responsive-nav-link>
            </div>

            <div class="mt-4 border-t border-border/70 px-4 pt-4">
                <p class="font-bold text-white">{{ Auth::user()->name }}</p>
                <p class="text-sm text-slate-400">Level {{ Auth::user()->level ?? 1 }} Adventurer</p>
                <div class="mt-4 flex gap-2">
                    <a href="{{ route('quests.create') }}" class="qb-primary flex-1 px-4">Post Quest</a>
                    <form method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit" class="qb-secondary w-full px-4">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
