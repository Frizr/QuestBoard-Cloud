<x-app-layout>
    @php
        $profileRank = match (true) {
            ($user->level ?? 1) >= 20 => 'Grandmaster',
            ($user->level ?? 1) >= 12 => 'Champion',
            ($user->level ?? 1) >= 7 => 'Vanguard',
            ($user->level ?? 1) >= 3 => 'Pathfinder',
            default => 'Initiate',
        };
        $hasUploadedAvatar = filled($user->avatar_path);
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="qb-section-kicker">Identity Sanctum</p>
                <h1 class="mt-2 qb-heading text-3xl sm:text-4xl">Adventurer Profile</h1>
                <p class="mt-2 max-w-2xl text-base text-slate-400">Manage your portrait, guild identity, credentials, and account status.</p>
            </div>
            <span class="inline-flex w-fit items-center gap-2 rounded-full border border-royal/40 bg-royal/10 px-4 py-2 text-sm font-bold text-royal shadow-gold">
                Level {{ $user->level ?? 1 }} {{ $profileRank }}
            </span>
        </div>
    </x-slot>

    <div class="qb-page-shell">
        <div class="mx-auto grid max-w-7xl gap-6 lg:grid-cols-[320px_1fr]">
            <aside class="qb-panel-soft relative overflow-hidden p-6">
                <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-royal/10 blur-3xl"></div>
                <div class="absolute -bottom-16 -left-16 h-44 w-44 rounded-full bg-violet/15 blur-3xl"></div>

                <div class="relative">
                    <x-adventurer-avatar :user="$user" size="xl" />
                </div>
                <h2 class="mt-5 break-words font-display text-2xl font-bold text-white">{{ $user->name }}</h2>
                <p class="mt-1 text-sm text-slate-400">{{ $profileRank }} Adventurer</p>

                <div class="mt-6 grid gap-3">
                    <div class="rounded-lg border border-border bg-obsidian/40 p-4">
                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Total EXP</p>
                        <p class="mt-2 font-display text-3xl font-bold text-royal">{{ number_format($user->total_exp ?? 0) }}</p>
                    </div>
                    <div class="rounded-lg border border-border bg-obsidian/40 p-4">
                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Portrait Source</p>
                        <p class="mt-2 text-sm font-bold text-slate-200">{{ $hasUploadedAvatar ? 'Uploaded Photo' : 'RPG Class Template' }}</p>
                    </div>
                </div>
            </aside>

            <div class="space-y-6">
                <section class="qb-panel p-6 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </section>

                <section class="qb-panel p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </section>

                <section class="qb-panel border-crimson/30 p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
