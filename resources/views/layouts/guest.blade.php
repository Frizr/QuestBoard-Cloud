<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'QuestBoard') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-obsidian font-sans text-slate-100 antialiased">
        <div class="relative isolate flex min-h-screen flex-col items-center justify-center overflow-hidden bg-[radial-gradient(circle_at_20%_20%,rgba(109,40,217,0.35),transparent_30%),linear-gradient(180deg,#050816_0%,#0B1020_100%)] px-4 py-8">
            <img src="{{ asset('videos/questboard-bg.svg') }}" alt="" class="absolute inset-0 -z-40 h-full w-full object-cover">
            <video class="absolute inset-0 -z-30 h-full w-full object-cover opacity-45" autoplay muted loop playsinline poster="{{ asset('videos/questboard-bg.svg') }}">
                <source src="{{ asset('videos/questboard-bg.webm') }}" type="video/webm">
                <source src="{{ asset('videos/questboard-bg.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute inset-0 -z-20 bg-obsidian/78"></div>
            <div class="absolute inset-x-0 bottom-0 -z-10 h-1/2 bg-gradient-to-t from-obsidian to-transparent"></div>

            <div class="mb-8 text-center">
                <a href="/" class="inline-flex items-center justify-center gap-3">
                    <span class="grid h-12 w-12 place-items-center rounded-lg border border-royal/50 bg-violet/20 font-display text-2xl font-bold text-royal shadow-gold">Q</span>
                    <span class="font-display text-4xl font-bold text-violet-100 qb-title-glow">QuestBoard</span>
                </a>
            </div>

            <div class="w-full overflow-hidden rounded-lg border border-border/90 bg-card/85 px-6 py-6 shadow-2xl shadow-black/50 backdrop-blur-xl sm:max-w-md">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
