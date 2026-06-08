<section>
    @php
        $avatarTemplates = \App\Support\AvatarTemplates::all();
        $selectedTemplate = \App\Support\AvatarTemplates::normalize(old('avatar_template', $user->avatar_template));
        $selectedTemplateMeta = \App\Support\AvatarTemplates::find($selectedTemplate);
        $hasUploadedPortrait = filled($user->avatar_path);
        $showUploadedPreview = $hasUploadedPortrait && ! old('remove_avatar');
    @endphp

    <header>
        <h2 class="font-display text-2xl font-bold text-white">
            Guild Identity & Portrait
        </h2>

        <p class="mt-2 text-sm leading-6 text-slate-400">
            Upload your own adventurer portrait or choose a local fantasy character template for your guild identity.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form
        method="post"
        action="{{ route('profile.update') }}"
        enctype="multipart/form-data"
        class="mt-6 space-y-7"
        x-data="{
            portrait: @js($selectedTemplate),
            fileName: '',
            previewUrl: null,
            removeUploaded: @js((bool) old('remove_avatar')),
            hasUploadedPortrait: @js($hasUploadedPortrait),
        }"
    >
        @csrf
        @method('patch')

        <div class="grid gap-5 xl:grid-cols-[260px_1fr]">
            <div class="rounded-lg border border-border bg-obsidian/45 p-5 text-center shadow-inner shadow-black/30">
                <div class="mx-auto grid h-40 w-40 place-items-center">
                    <img
                        x-show="previewUrl"
                        x-cloak
                        :src="previewUrl"
                        alt="Selected upload preview"
                        class="h-40 w-40 rounded-full border border-royal/70 bg-obsidian object-cover shadow-gold ring-2 ring-black/30"
                    >

                    @if ($hasUploadedPortrait)
                        <div x-show="! previewUrl && hasUploadedPortrait && ! removeUploaded" x-cloak>
                            <x-adventurer-avatar :user="$user" size="xl" />
                        </div>
                    @endif

                    @foreach ($avatarTemplates as $value => $template)
                        <div x-show="! previewUrl && (! hasUploadedPortrait || removeUploaded) && portrait === '{{ $value }}'" x-cloak>
                            <x-avatar-portrait :template="$value" class="h-40 w-40 rounded-full border border-royal/70 shadow-gold ring-2 ring-black/30" />
                        </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-500" x-show="previewUrl" x-cloak>
                        Custom Portrait Queued
                    </p>

                    @if ($showUploadedPreview)
                        <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-500" x-show="! previewUrl && hasUploadedPortrait && ! removeUploaded" x-cloak>
                            Uploaded Portrait
                        </p>
                    @endif

                    @foreach ($avatarTemplates as $value => $template)
                        <div x-show="! previewUrl && (! hasUploadedPortrait || removeUploaded) && portrait === '{{ $value }}'" x-cloak>
                            <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-500">Selected Portrait</p>
                            <p class="mt-2 font-display text-xl font-bold text-white">{{ $template['name'] }}</p>
                            <p class="mt-1 text-sm font-semibold text-royal">{{ $template['title'] }}</p>
                        </div>
                    @endforeach

                    <p class="mt-3 text-xs leading-5 text-slate-400" x-show="previewUrl" x-cloak>
                        This uploaded image will override your selected character template after saving.
                    </p>

                    @if ($showUploadedPreview)
                        <p class="mt-3 text-xs leading-5 text-slate-400" x-show="! previewUrl && hasUploadedPortrait && ! removeUploaded" x-cloak>
                            Your uploaded photo is active. Remove it below to return to the {{ $selectedTemplateMeta['name'] }} template.
                        </p>
                    @endif
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    <label for="avatar" class="block cursor-pointer rounded-lg border border-dashed border-violet/50 bg-violet/10 p-5 transition hover:border-royal/60 hover:bg-royal/10">
                        <span class="block font-display text-xl font-bold text-white">Upload Adventurer Portrait</span>
                        <span class="mt-2 block text-sm leading-6 text-slate-400">PNG, JPG, or WEBP up to 2 MB. Uploaded art always overrides the character template.</span>
                        <span class="mt-4 flex flex-wrap items-center gap-3">
                            <span class="inline-flex rounded-md border border-border bg-panel px-4 py-2 text-sm font-bold text-slate-200">
                                Choose File
                            </span>
                            <span class="min-w-0 break-all text-sm font-semibold text-royal" x-text="fileName"></span>
                        </span>
                    </label>
                    <input
                        id="avatar"
                        name="avatar"
                        type="file"
                        accept="image/png,image/jpeg,image/webp"
                        class="sr-only"
                        @change="
                            const file = $event.target.files[0] || null;
                            fileName = file ? file.name : '';
                            if (previewUrl) URL.revokeObjectURL(previewUrl);
                            previewUrl = file ? URL.createObjectURL(file) : null;
                            if (file) removeUploaded = false;
                        "
                    >
                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                </div>

                @if ($user->avatar_path)
                    <label class="flex items-start gap-3 rounded-lg border border-border bg-panel/60 p-4 text-sm text-slate-300">
                        <input type="checkbox" name="remove_avatar" value="1" class="mt-1 rounded border-border bg-obsidian text-violet focus:ring-violet" x-model="removeUploaded" @checked(old('remove_avatar'))>
                        <span>
                            <span class="block font-bold text-white">Use selected template instead</span>
                            <span class="mt-1 block text-slate-400">This removes the uploaded photo and returns your profile to the selected character portrait.</span>
                        </span>
                    </label>
                    <x-input-error class="mt-2" :messages="$errors->get('remove_avatar')" />
                @endif
            </div>
        </div>

        <div>
            <p class="text-sm font-bold tracking-wide text-slate-200">Adventurer Character Portraits</p>
            <p class="mt-1 text-xs text-slate-500">Choose a local portrait from the imported zip. If you upload a photo, this remains your fallback identity.</p>
            <div class="mt-3 grid gap-3 sm:grid-cols-2 2xl:grid-cols-3">
                @foreach ($avatarTemplates as $value => $template)
                    <label :class="portrait === '{{ $value }}' ? 'border-royal bg-royal/10 text-royal shadow-gold' : 'border-border bg-panel/60 text-slate-300 hover:border-violet/50 hover:bg-violet/5 hover:text-white'" class="group cursor-pointer rounded-lg border p-4 transition">
                        <input type="radio" name="avatar_template" value="{{ $value }}" x-model="portrait" class="sr-only" @checked($selectedTemplate === $value)>
                        <div class="flex items-start gap-4">
                            <x-avatar-portrait :template="$value" class="h-20 w-20 shrink-0 rounded-full border border-current/40 shadow-lg shadow-black/30" />
                            <span class="min-w-0">
                                <span class="flex items-center gap-2">
                                    <span class="h-2.5 w-2.5 shrink-0 rounded-full" style="background-color: {{ $template['accent'] }}"></span>
                                    <span class="block font-display text-lg font-bold">{{ $template['name'] }}</span>
                                </span>
                                <span class="mt-1 block text-xs font-semibold text-slate-400">{{ $template['title'] }}</span>
                                <span class="mt-2 block text-xs leading-5 text-slate-500 group-hover:text-slate-400">{{ $template['role'] }}</span>
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
