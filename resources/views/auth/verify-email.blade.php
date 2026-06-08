<x-guest-layout>
    <div class="text-center">
        <p class="qb-section-kicker">Guild Verification</p>
        <h1 class="mt-2 font-display text-3xl font-bold text-white">Verify Email</h1>
    </div>

    <div class="mt-4 text-sm leading-6 text-slate-400">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mt-5 rounded-md border border-emerald-400/30 bg-emerald-500/15 px-4 py-3 text-sm font-semibold text-emerald-100">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button>{{ __('Resend Verification Email') }}</x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="rounded-md text-sm font-bold text-slate-400 underline transition hover:text-white focus:outline-none focus:ring-2 focus:ring-violet focus:ring-offset-2 focus:ring-offset-obsidian">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
