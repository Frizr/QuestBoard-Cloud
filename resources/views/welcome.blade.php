<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'QuestBoard') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-obsidian font-sans text-slate-100 antialiased">
        <main class="overflow-hidden">
            <section class="relative isolate min-h-[94vh] overflow-hidden bg-[radial-gradient(circle_at_20%_20%,rgba(109,40,217,0.35),transparent_28%),radial-gradient(circle_at_80%_28%,rgba(251,191,36,0.14),transparent_26%),linear-gradient(180deg,#050816_0%,#0B1020_68%,#050816_100%)]">
                <img src="{{ asset('videos/questboard-bg.svg') }}" alt="" class="absolute inset-0 -z-40 h-full w-full object-cover">
                <video class="absolute inset-0 -z-30 h-full w-full object-cover opacity-55" autoplay muted loop playsinline poster="{{ asset('videos/questboard-bg.svg') }}">
                    <source src="{{ asset('videos/questboard-bg.webm') }}" type="video/webm">
                    <source src="{{ asset('videos/questboard-bg.mp4') }}" type="video/mp4">
                </video>
                <div class="absolute inset-0 -z-20 bg-obsidian/70"></div>
                <div class="absolute inset-x-0 bottom-0 -z-10 h-56 bg-gradient-to-t from-obsidian via-obsidian/80 to-transparent"></div>

                <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-5 sm:px-6 lg:px-8">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <span class="grid h-11 w-11 place-items-center rounded-md border border-royal/50 bg-violet/20 font-display text-xl font-bold text-royal shadow-gold">Q</span>
                        <span class="font-display text-xl font-bold text-white">QuestBoard</span>
                    </a>

                    @if (Route::has('login'))
                        <div class="flex items-center gap-2 text-sm font-bold">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="qb-gold px-4 py-2">Enter Guild Hall</a>
                            @else
                                <a href="{{ route('login') }}" class="hidden rounded-md px-4 py-2 text-slate-200 transition hover:bg-white/10 hover:text-white sm:inline-flex">
                                    Enter Guild Hall
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="qb-gold px-4 py-2">
                                        Start Your Journey
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </nav>

                <div class="mx-auto grid max-w-7xl items-center gap-10 px-5 pb-12 pt-14 sm:px-6 sm:pt-20 lg:grid-cols-[1.02fr_0.98fr] lg:px-8 lg:pb-16 lg:pt-24">
                    <div class="max-w-3xl">
                        <div class="inline-flex items-center gap-2 rounded-full border border-royal/25 bg-panel/60 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.18em] text-royal shadow-gold backdrop-blur">
                            Adventurer Guild Productivity System
                        </div>

                        <h1 class="mt-7 font-display text-5xl font-extrabold leading-tight text-white qb-title-glow sm:text-6xl lg:text-7xl">
                            <span class="block text-royal qb-gold-glow">QuestBoard</span>
                            Level Up Your Productivity
                        </h1>

                        <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                            Turn your daily tasks into RPG-style quests. Complete missions, gain EXP, and level up your life.
                        </p>

                        <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="qb-gold">
                                    <span>+</span>
                                    Enter Guild Hall
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="qb-gold">
                                    <span>+</span>
                                    Start Your Journey
                                </a>
                                <a href="{{ route('login') }}" class="qb-secondary">
                                    <span>></span>
                                    Enter Guild Hall
                                </a>
                            @endauth
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -inset-6 rounded-full bg-violet/20 blur-3xl"></div>
                        <div class="relative rounded-lg border border-border bg-card/90 shadow-2xl shadow-black/50 backdrop-blur">
                            <div class="flex items-center gap-2 border-b border-border bg-[#15111d] px-4 py-3">
                                <span class="h-2.5 w-2.5 rounded-full bg-crimson"></span>
                                <span class="h-2.5 w-2.5 rounded-full bg-royal"></span>
                                <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                                <span class="ms-auto rounded-md border border-border bg-obsidian/60 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.18em] text-slate-500">Guild Hall Preview</span>
                            </div>

                            <div class="grid gap-5 p-5 lg:grid-cols-[180px_1fr]">
                                <div class="rounded-lg border border-border bg-obsidian/45 p-4">
                                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Adventurer</p>
                                    <div class="mt-4 flex items-center gap-3">
                                        <span class="grid h-12 w-12 place-items-center rounded-full border border-royal/50 bg-royal/10 font-display text-lg font-bold text-royal">12</span>
                                        <div>
                                            <p class="font-bold text-white">Level 12</p>
                                            <p class="text-xs text-slate-400">Paladin</p>
                                        </div>
                                    </div>
                                    <div class="mt-5 h-2 overflow-hidden rounded-full bg-panel">
                                        <div class="h-full w-3/4 rounded-full bg-gradient-to-r from-frost to-violet"></div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="font-display text-xl font-bold text-white">Active Quests</p>
                                            <p class="text-sm text-slate-400">Complete objectives to earn rewards.</p>
                                        </div>
                                        <span class="rounded-md bg-violet px-5 py-2 text-xs font-bold text-white">New</span>
                                    </div>

                                    <div class="rounded-lg border border-royal/45 bg-royal/10 p-4 shadow-gold">
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <p class="text-xs font-extrabold uppercase tracking-[0.16em] text-royal">Boss Quest</p>
                                                <h3 class="mt-2 font-display text-xl font-bold text-white">Finish Quarterly Report</h3>
                                                <p class="mt-2 text-sm text-slate-400">The final boss of the week approaches.</p>
                                            </div>
                                            <span class="rounded-md border border-royal/40 px-2 py-1 text-xs font-bold text-royal">500 EXP</span>
                                        </div>
                                    </div>

                                    <div class="rounded-lg border border-frost/25 bg-frost/10 p-4">
                                        <div class="flex items-center justify-between gap-4">
                                            <h3 class="font-display text-lg font-bold text-white">Clear Inbox Zero</h3>
                                            <span class="rounded-md border border-frost/40 px-2 py-1 text-xs font-bold text-sky-100">Normal</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-obsidian px-5 py-16 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    <div class="text-center">
                        <p class="qb-section-kicker">The Guild Way</p>
                        <h2 class="mt-3 font-display text-3xl font-bold text-white sm:text-4xl">A mission board for real work.</h2>
                        <p class="mx-auto mt-4 max-w-2xl text-slate-400">QuestBoard keeps task management readable while giving progress, reward, and urgency a stronger visual identity.</p>
                    </div>

                    <div class="mt-10 grid gap-5 lg:grid-cols-2">
                        <div class="qb-panel-soft p-6">
                            <p class="qb-section-kicker text-red-300">The Mundane Struggle</p>
                            <div class="mt-5 grid gap-3">
                                @foreach (['Tasks are scattered everywhere.', 'Deadlines are often missed.', 'To-do lists feel boring.', 'Progress is hard to measure.', 'Motivation is often low.'] as $problem)
                                    <div class="rounded-md border border-border bg-panel/70 p-4 text-sm font-semibold text-slate-400">{{ $problem }}</div>
                                @endforeach
                            </div>
                        </div>

                        <div class="qb-panel border-violet/40 p-6 shadow-arcane">
                            <p class="qb-section-kicker">The RPG Mechanics Solution</p>
                            <h3 class="mt-3 font-display text-2xl font-bold text-white">Turn obligations into quests with visible rewards.</h3>
                            <div class="mt-6 grid gap-3 sm:grid-cols-2">
                                @foreach ([
                                    ['title' => 'Create Quests', 'body' => 'Draft clear mission briefings with category, difficulty, and deadline.'],
                                    ['title' => 'Gain EXP', 'body' => 'Completed quests add rewards to your profile.'],
                                    ['title' => 'Level Up', 'body' => 'Your level reflects consistent progress.'],
                                    ['title' => 'Hall of Heroes', 'body' => 'Compare top adventurers without exposing private emails.'],
                                ] as $feature)
                                    <div class="rounded-md border border-border bg-obsidian/45 p-4">
                                        <h4 class="font-display font-bold text-white">{{ $feature['title'] }}</h4>
                                        <p class="mt-2 text-sm leading-6 text-slate-400">{{ $feature['body'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="border-y border-border bg-[#15111d] px-5 py-16 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    <div class="grid gap-5 md:grid-cols-3">
                        @foreach ([
                            ['title' => 'Quest Contracts', 'body' => 'Create tasks with difficulty, status, category, deadline, and EXP reward.'],
                            ['title' => 'Guild Divisions', 'body' => 'Group missions into meaningful categories for focused planning.'],
                            ['title' => 'Adventurer Status', 'body' => 'Track total EXP, level, overdue quests, and active progress from the Guild Hall.'],
                        ] as $item)
                            <article class="qb-panel-soft p-6 transition hover:-translate-y-1 hover:border-violet/50">
                                <span class="grid h-11 w-11 place-items-center rounded-md border border-violet/35 bg-violet/15 font-display font-bold text-violet-100">{{ $loop->iteration }}</span>
                                <h3 class="mt-6 font-display text-xl font-bold text-white">{{ $item['title'] }}</h3>
                                <p class="mt-3 text-sm leading-6 text-slate-400">{{ $item['body'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="bg-obsidian px-5 py-16 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    <div class="text-center">
                        <p class="qb-section-kicker">How It Works</p>
                        <h2 class="mt-3 font-display text-3xl font-bold text-white sm:text-4xl">The Adventurer's Path</h2>
                    </div>
                    <div class="mt-10 grid gap-5 md:grid-cols-4">
                        @foreach ([
                            ['title' => 'Create', 'body' => 'Post a new quest to the board.'],
                            ['title' => 'Complete', 'body' => 'Finish the mission and mark it done.'],
                            ['title' => 'Gain EXP', 'body' => 'Claim rewards based on difficulty.'],
                            ['title' => 'Level Up', 'body' => 'Build momentum through visible progress.'],
                        ] as $step)
                            <article class="text-center">
                                <div class="mx-auto grid h-16 w-16 place-items-center rounded-full border border-border bg-card font-display text-xl font-bold text-royal shadow-gold">{{ $loop->iteration }}</div>
                                <h3 class="mt-4 font-display text-lg font-bold text-white">{{ $step['title'] }}</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-400">{{ $step['body'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <footer class="border-t border-border bg-obsidian px-5 py-8 sm:px-6 lg:px-8">
                <div class="mx-auto flex max-w-7xl flex-col gap-3 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                    <p class="font-display text-slate-400">QuestBoard</p>
                    <p>Level Up Your Productivity</p>
                </div>
            </footer>
        </main>
    </body>
</html>
