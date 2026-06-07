<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'QuestBoard') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#080712] font-sans text-white antialiased">
        <main class="relative isolate min-h-screen overflow-hidden">
            <img
                src="{{ asset('images/questboard-hero.png') }}"
                alt=""
                class="absolute inset-0 -z-20 h-full w-full object-cover object-center"
            >
            <div class="absolute inset-0 -z-10 bg-[#080712]/70"></div>
            <div class="absolute inset-x-0 bottom-0 -z-10 h-40 bg-gradient-to-t from-[#080712] to-transparent"></div>

            <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-5 sm:px-6 lg:px-8">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <span class="grid h-10 w-10 place-items-center rounded-md border border-amber-300/40 bg-purple-950/60 text-lg font-black text-amber-300 shadow-lg shadow-purple-950/30">
                        Q
                    </span>
                    <span class="text-lg font-semibold tracking-wide text-white">QuestBoard</span>
                </a>

                @if (Route::has('login'))
                    <div class="flex items-center gap-2 text-sm font-semibold">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="rounded-md border border-amber-300/40 bg-amber-300 px-4 py-2 text-[#171023] shadow-lg shadow-amber-500/10 transition hover:bg-amber-200">
                                Open Board
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-md px-4 py-2 text-slate-200 transition hover:bg-white/10 hover:text-white">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-md border border-amber-300/40 bg-amber-300 px-4 py-2 text-[#171023] shadow-lg shadow-amber-500/10 transition hover:bg-amber-200">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>

            <section class="mx-auto grid max-w-7xl items-center gap-10 px-5 pb-20 pt-16 sm:px-6 sm:pt-24 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:pb-28 lg:pt-28">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full border border-purple-300/20 bg-purple-950/50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-amber-200 shadow-lg shadow-purple-950/30">
                        Mission Control for Focused Work
                    </div>

                    <h1 class="mt-6 text-4xl font-black leading-tight text-white sm:text-6xl lg:text-7xl">
                        Turn every task into a quest worth finishing.
                    </h1>

                    <p class="mt-6 max-w-2xl text-base leading-8 text-slate-300 sm:text-lg">
                        QuestBoard gives your daily work a polished RPG mission-board flow: capture quests, track priority, move progress, and build momentum through a clear level system.
                    </p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center rounded-md bg-purple-500 px-6 py-3 text-sm font-bold text-white shadow-xl shadow-purple-950/40 transition hover:-translate-y-0.5 hover:bg-purple-400">
                                Enter Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-md bg-purple-500 px-6 py-3 text-sm font-bold text-white shadow-xl shadow-purple-950/40 transition hover:-translate-y-0.5 hover:bg-purple-400">
                                Start Questing
                            </a>
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-md border border-white/15 bg-white/10 px-6 py-3 text-sm font-bold text-white backdrop-blur transition hover:-translate-y-0.5 hover:bg-white/15">
                                Continue Session
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="rounded-lg border border-white/10 bg-[#120f22]/80 p-4 shadow-2xl shadow-purple-950/40 backdrop-blur md:p-5">
                    <div class="rounded-md border border-amber-300/20 bg-[#0d0a18] p-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-amber-300">Today&apos;s Board</p>
                                <h2 class="mt-1 text-xl font-bold text-white">Guild Operations</h2>
                            </div>
                            <span class="rounded-full bg-purple-500/20 px-3 py-1 text-xs font-bold text-purple-200 ring-1 ring-purple-300/20">Level 4</span>
                        </div>

                        <div class="mt-5 grid gap-3">
                            <div class="rounded-md border border-amber-300/20 bg-amber-300/10 p-4 transition hover:border-amber-200/50">
                                <div class="flex items-center justify-between gap-3">
                                    <h3 class="font-semibold text-white">Deploy production build</h3>
                                    <span class="rounded-full bg-amber-300 px-2.5 py-1 text-xs font-black text-[#171023]">Epic</span>
                                </div>
                                <p class="mt-2 text-sm text-slate-300">Verify assets, run migrations, and publish the release notes.</p>
                            </div>

                            <div class="rounded-md border border-purple-300/20 bg-purple-500/10 p-4 transition hover:border-purple-200/50">
                                <div class="flex items-center justify-between gap-3">
                                    <h3 class="font-semibold text-white">Refine dashboard flow</h3>
                                    <span class="rounded-full bg-purple-400/20 px-2.5 py-1 text-xs font-bold text-purple-100 ring-1 ring-purple-200/20">Active</span>
                                </div>
                                <p class="mt-2 text-sm text-slate-300">Move quests across the board and keep the next step obvious.</p>
                            </div>

                            <div class="rounded-md border border-emerald-300/20 bg-emerald-500/10 p-4 transition hover:border-emerald-200/50">
                                <div class="flex items-center justify-between gap-3">
                                    <h3 class="font-semibold text-white">Ship focused session</h3>
                                    <span class="rounded-full bg-emerald-400/20 px-2.5 py-1 text-xs font-bold text-emerald-100 ring-1 ring-emerald-200/20">Done</span>
                                </div>
                                <div class="mt-3 h-2 overflow-hidden rounded-full bg-white/10">
                                    <div class="h-full w-3/4 rounded-full bg-amber-300"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-5 py-16 sm:px-6 lg:px-8">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">The Problem</p>
                    <h2 class="mt-3 text-3xl font-black text-white">Productivity usually feels scattered.</h2>
                </div>
                <div class="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-5">
                    @foreach ([
                        'Tasks are scattered everywhere.',
                        'Deadlines are often missed.',
                        'To-do lists feel boring.',
                        'Progress is hard to measure.',
                        'Motivation is often low.',
                    ] as $problem)
                        <div class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-5 shadow-xl shadow-purple-950/10">
                            <p class="text-sm font-semibold leading-6 text-slate-300">{{ $problem }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-5 py-16 sm:px-6 lg:px-8">
                <div class="grid gap-8 rounded-lg border border-purple-300/20 bg-purple-950/40 p-6 shadow-2xl shadow-purple-950/30 lg:grid-cols-[0.9fr_1.1fr] lg:p-8">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">The Solution</p>
                        <h2 class="mt-3 text-3xl font-black text-white">QuestBoard turns work into a rewarding loop.</h2>
                        <p class="mt-4 text-sm leading-7 text-slate-300">
                            Organize activities into quests, group them by category, track deadlines, gain EXP after completion, and level up through consistent progress.
                        </p>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2">
                        @foreach ([
                            'Organize activities into quests.',
                            'Group quests by category.',
                            'Track progress and deadlines.',
                            'Gain EXP after completing quests.',
                            'Level up through productivity.',
                        ] as $solution)
                            <div class="rounded-md border border-white/10 bg-[#0F172A]/80 p-4 text-sm font-semibold text-slate-200">
                                {{ $solution }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-5 py-16 sm:px-6 lg:px-8">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">Features</p>
                    <h2 class="mt-3 text-3xl font-black text-white">Everything needed for a clean mission board.</h2>
                </div>
                <div class="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    @foreach ([
                        ['title' => 'Quest CRUD', 'body' => 'Create, edit, delete, filter, and view quest details.'],
                        ['title' => 'Categories', 'body' => 'Group quests into Work, Study, Health, Projects, and more.'],
                        ['title' => 'EXP and Level', 'body' => 'Complete quests to gain EXP and raise your level.'],
                        ['title' => 'Leaderboard', 'body' => 'See top users by total EXP without exposing private data.'],
                    ] as $feature)
                        <div class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-5 shadow-xl shadow-purple-950/10 transition hover:-translate-y-0.5 hover:border-purple-300/30">
                            <h3 class="font-bold text-white">{{ $feature['title'] }}</h3>
                            <p class="mt-3 text-sm leading-6 text-slate-400">{{ $feature['body'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-5 py-16 sm:px-6 lg:px-8">
                <div class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-6 shadow-xl shadow-purple-950/20 lg:p-8">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">How It Works</p>
                    <div class="mt-6 grid gap-4 md:grid-cols-4">
                        @foreach ([
                            ['step' => '01', 'title' => 'Register', 'body' => 'Create your account and enter the mission board.'],
                            ['step' => '02', 'title' => 'Create quests', 'body' => 'Add title, category, difficulty, status, and deadline.'],
                            ['step' => '03', 'title' => 'Complete work', 'body' => 'Finish quests to claim EXP rewards.'],
                            ['step' => '04', 'title' => 'Level up', 'body' => 'Track progress and climb the leaderboard.'],
                        ] as $item)
                            <div class="rounded-md border border-white/10 bg-[#0F172A]/80 p-5">
                                <p class="text-sm font-black text-amber-300">{{ $item['step'] }}</p>
                                <h3 class="mt-3 font-bold text-white">{{ $item['title'] }}</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-400">{{ $item['body'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <footer class="border-t border-white/10 px-5 py-8 sm:px-6 lg:px-8">
                <div class="mx-auto flex max-w-7xl flex-col gap-3 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                    <p>QuestBoard - Level Up Your Productivity</p>
                    <p>Built with Laravel, Breeze, Tailwind CSS, Vite, and MySQL-ready migrations.</p>
                </div>
            </footer>
        </main>
    </body>
</html>
