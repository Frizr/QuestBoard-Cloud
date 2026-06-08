<x-guest-layout>
    <div class="text-center">
        <p class="qb-section-kicker">Account Recovery</p>
        <h1 class="mt-2 font-display text-3xl font-bold text-white">Recover Your Rune</h1>
    </div>

    <div class="mt-4 text-sm leading-6 text-slate-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <x-auth-session-status class="mt-5 rounded-md border border-emerald-400/30 bg-emerald-500/15 px-4 py-3 text-sm font-semibold text-emerald-100" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">{{ __('Email Password Reset Link') }}</x-primary-button>
    </form>
</x-guest-layout>
