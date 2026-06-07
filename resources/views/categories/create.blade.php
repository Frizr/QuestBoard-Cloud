<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">New Category</p>
            <h1 class="mt-2 text-2xl font-black text-white sm:text-3xl">Create quest category</h1>
        </div>
    </x-slot>

    <div class="px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-xl rounded-lg border border-white/10 bg-[#1E293B]/70 p-6 shadow-xl shadow-purple-950/20">
            <form method="POST" action="{{ route('categories.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-300">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" maxlength="100" required class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                    @error('name')
                        <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="color" class="block text-sm font-semibold text-slate-300">Color</label>
                    <input id="color" name="color" type="text" value="{{ old('color', '#7C3AED') }}" maxlength="30" class="mt-1 block w-full rounded-md border-white/10 bg-[#0F172A] text-slate-100 focus:border-purple-300 focus:ring-purple-300">
                    @error('color')
                        <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="rounded-md bg-purple-500 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-purple-400">Create</button>
                    <a href="{{ route('categories.index') }}" class="rounded-md border border-white/10 px-4 py-2.5 text-sm font-bold text-slate-200 transition hover:bg-white/10">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
