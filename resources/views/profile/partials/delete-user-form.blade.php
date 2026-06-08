<section class="space-y-6">
    <header>
        <h2 class="font-display text-2xl font-bold text-red-100">
            Retire Adventurer
        </h2>

        <p class="mt-2 text-sm leading-6 text-slate-400">
            Permanently delete this account and remove its saved guild data.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Retire Account</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="font-display text-2xl font-bold text-red-100">
                Are you sure you want to retire this adventurer?
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-400">
                This permanently deletes the account and its data. Enter your password to confirm.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Retire Account
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
