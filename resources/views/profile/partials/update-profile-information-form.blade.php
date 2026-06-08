<section>
    @php
        $avatarTemplates = \App\Support\AvatarTemplates::all();
        $selectedTemplate = old('avatar_template', \App\Support\AvatarTemplates::normalize($user->avatar_template));
        $showUploadedPreview = filled($user->avatar_path) && ! old('remove_avatar');
    @endphp

    <header>
        <h2 class="font-display text-2xl font-bold text-white">
            Identity & Portrait
        </h2>

        <p class="mt-2 text-sm leading-6 text-slate-400">
            Upload your own photo or choose a tabletop fantasy class portrait template for your guild identity.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-7" x-data="{ portrait: @js($selectedTemplate), fileName: '' }">
        @csrf
        @method('patch')

        <div class="grid gap-5 xl:grid-cols-[220px_1fr]">
            <div class="rounded-lg border border-border bg-obsidian/35 p-5 text-center">
                <div class="mx-auto grid h-36 w-36 place-items-center">
                    @if ($showUploadedPreview)
                        <x-adventurer-avatar :user="$user" size="xl" />
                    @else
                        @foreach ($avatarTemplates as $value => $template)
                            <div x-show="portrait === '{{ $value }}'" x-cloak>
                                <x-avatar-portrait :template="$value" class="h-36 w-36 rounded-full border border-royal/70 shadow-gold" />
                            </div>
                        @endforeach
                    @endif
                </div>
                <p class="mt-4 text-xs font-extrabold uppercase tracking-[0.18em] text-slate-500">
                    {{ $showUploadedPreview ? 'Uploaded Portrait' : 'Selected Template' }}
                </p>
                @if ($showUploadedPreview)
                    <p class="mt-2 text-xs leading-5 text-slate-400">Your uploaded photo is active. Remove it below to use the selected class template.</p>
                @endif
            </div>

            <div class="space-y-5">
                <div>
                    <label for="avatar" class="block cursor-pointer rounded-lg border border-dashed border-violet/50 bg-violet/10 p-5 transition hover:border-royal/60 hover:bg-royal/10">
                        <span class="block font-display text-xl font-bold text-white">Upload Profile Photo</span>
                        <span class="mt-2 block text-sm leading-6 text-slate-400">PNG, JPG, or WEBP up to 2 MB. This overrides the template portrait.</span>
                        <span class="mt-4 inline-flex rounded-md border border-border bg-panel px-4 py-2 text-sm font-bold text-slate-200">
                            Choose File
                        </span>
                        <span class="ml-3 text-sm font-semibold text-royal" x-text="fileName"></span>
                    </label>
                    <input id="avatar" name="avatar" type="file" accept="image/png,image/jpeg,image/webp" class="sr-only" @change="fileName = $event.target.files[0]?.name || ''">
                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                </div>

                @if ($user->avatar_path)
                    <label class="flex items-start gap-3 rounded-lg border border-border bg-panel/60 p-4 text-sm text-slate-300">
                        <input type="checkbox" name="remove_avatar" value="1" class="mt-1 rounded border-border bg-obsidian text-violet focus:ring-violet" @checked(old('remove_avatar'))>
                        <span>
                            <span class="block font-bold text-white">Use selected template instead</span>
                            <span class="mt-1 block text-slate-400">This removes the uploaded photo and returns your profile to the RPG class portrait.</span>
                        </span>
                    </label>
                    <x-input-error class="mt-2" :messages="$errors->get('remove_avatar')" />
                @endif
            </div>
        </div>

        <div>
            <p class="text-sm font-bold tracking-wide text-slate-200">RPG Class Portrait Template</p>
            <p class="mt-1 text-xs text-slate-500">Choose a free local template. If you upload a photo, the template stays as your fallback.</p>
            <div class="mt-3 grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($avatarTemplates as $value => $template)
                    <label :class="portrait === '{{ $value }}' ? 'border-royal bg-royal/10 text-royal shadow-gold' : 'border-border bg-panel/60 text-slate-300 hover:border-violet/50 hover:text-white'" class="cursor-pointer rounded-lg border p-4 transition">
                        <input type="radio" name="avatar_template" value="{{ $value }}" x-model="portrait" class="sr-only" @checked($selectedTemplate === $value)>
                        <div class="flex items-center gap-4">
                            <x-avatar-portrait :template="$value" class="h-16 w-16 shrink-0 rounded-full border border-current/40" />
                            <span class="min-w-0">
                                <span class="block font-display text-lg font-bold">{{ $template['name'] }}</span>
                                <span class="mt-1 block text-xs font-semibold text-slate-400">{{ $template['title'] }}</span>
                            </span>
                        </div>
                    </label>
                @endforeach
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('avatar_template')" />
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <x-input-label for="name" value="Adventurer Name" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" value="Guild Email" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="mt-2 text-sm text-slate-300">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="rounded-md text-sm font-bold text-violet-200 underline hover:text-white focus:outline-none focus:ring-2 focus:ring-violet focus:ring-offset-2 focus:ring-offset-obsidian">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm font-semibold text-emerald-300">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Save Identity</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-semibold text-emerald-300"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
