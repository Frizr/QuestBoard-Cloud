<x-guest-layout>
    <div class="text-center">
        <p class="qb-section-kicker">Secure Gate</p>
        <h1 class="mt-2 font-display text-3xl font-bold text-white">Confirm Password</h1>
    </div>

    <div class="mt-4 text-sm leading-6 text-slate-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="mt-6 space-y-5">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">{{ __('Confirm') }}</x-primary-button>
    </form>
</x-guest-layout>
