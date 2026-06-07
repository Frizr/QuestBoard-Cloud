<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'QuestBoard') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#080712] font-sans text-slate-100 antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center bg-[radial-gradient(circle_at_top_left,_rgba(124,58,237,0.28),_transparent_32%),linear-gradient(180deg,_#080712_0%,_#0F172A_100%)] px-4 py-8">
            <div>
                <a href="/">
                    <span class="grid h-16 w-16 place-items-center rounded-lg border border-amber-300/40 bg-purple-950/70 text-2xl font-black text-amber-300 shadow-lg shadow-purple-950/30">
                        Q
                    </span>
                </a>
            </div>

            <div class="mt-6 w-full overflow-hidden rounded-lg border border-white/10 bg-[#1E293B]/80 px-6 py-5 shadow-2xl shadow-purple-950/30 sm:max-w-md">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
