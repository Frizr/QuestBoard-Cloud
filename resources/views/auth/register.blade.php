<x-guest-layout>
    <div class="text-center">
        <p class="qb-section-kicker">Guild Registration</p>
        <h1 class="mt-2 font-display text-3xl font-bold text-white">Begin Your Adventure</h1>
        <p class="mt-3 text-sm leading-6 text-slate-400">Create your adventurer account and start leveling up your productivity.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="qb-gold w-full">
            Create Adventurer
        </button>

        <div class="border-t border-border pt-5 text-center text-sm text-slate-400">
            <span>Already registered?</span>
            <a href="{{ route('login') }}" class="font-bold text-violet-200 transition hover:text-white">Enter the Guild Hall</a>
        </div>
    </form>
</x-guest-layout>
