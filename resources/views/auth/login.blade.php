<x-guest-layout>
    <div class="text-center">
        <p class="qb-section-kicker">Guild Access</p>
        <h1 class="mt-2 font-display text-3xl font-bold text-white">Enter the Guild Hall</h1>
        <p class="mt-3 text-sm leading-6 text-slate-400">Continue your journey and manage your quests.</p>
    </div>

    <x-auth-session-status class="mt-5 rounded-md border border-emerald-400/30 bg-emerald-500/15 px-4 py-3 text-sm font-semibold text-emerald-100" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between gap-3">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-violet-200 transition hover:text-white" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="flex items-center gap-3 text-sm font-semibold text-slate-400">
            <input id="remember_me" type="checkbox" class="rounded border-border bg-panel text-violet focus:ring-violet focus:ring-offset-obsidian" name="remember">
            <span>{{ __('Remember me') }}</span>
        </label>

        <button type="submit" class="qb-primary w-full">
            Enter Guild Hall
        </button>

        <div class="border-t border-border pt-5 text-center text-sm text-slate-400">
            <span>New adventurer?</span>
            <a href="{{ route('register') }}" class="font-bold text-royal transition hover:text-amber-200">Begin Your Adventure</a>
        </div>
    </form>
</x-guest-layout>
