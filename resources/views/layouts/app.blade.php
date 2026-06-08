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
        <div class="min-h-screen bg-[radial-gradient(circle_at_15%_10%,rgba(109,40,217,0.22),transparent_30%),radial-gradient(circle_at_85%_15%,rgba(251,191,36,0.10),transparent_24%),linear-gradient(180deg,#050816_0%,#0B1020_45%,#050816_100%)]">
            @include('layouts.navigation')

            <main class="min-h-screen md:ml-72">
                @isset($header)
                    <header class="border-b border-border/70 bg-panel/65 backdrop-blur-xl">
                        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                {{ $slot }}
            </main>
        </div>
    </body>
</html>
