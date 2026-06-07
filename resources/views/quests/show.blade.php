<x-app-layout>
    @php
        $difficultyClasses = [
            'easy' => 'border-emerald-300/30 bg-emerald-500/15 text-emerald-100',
            'normal' => 'border-sky-300/30 bg-sky-500/15 text-sky-100',
            'hard' => 'border-purple-300/30 bg-purple-500/15 text-purple-100',
            'epic' => 'border-amber-300/50 bg-amber-300/15 text-amber-100',
            'boss' => 'border-red-300/40 bg-red-500/15 text-red-100',
        ];
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">Quest Detail</p>
                <h1 class="mt-2 text-2xl font-black text-white sm:text-3xl">{{ $quest->title }}</h1>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('quests.edit', $quest) }}" class="rounded-md bg-purple-500 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-purple-400">Edit</a>
                <a href="{{ route('quests.index') }}" class="rounded-md border border-white/10 px-4 py-2.5 text-sm font-bold text-slate-200 transition hover:bg-white/10">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-5xl gap-6 lg:grid-cols-[1fr_320px]">
            <section class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-6 shadow-xl shadow-purple-950/20">
                @if (session('status'))
                    <div class="mb-5 rounded-md border border-emerald-300/30 bg-emerald-500/15 px-4 py-3 text-sm font-semibold text-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="flex flex-wrap gap-2">
                    @if ($quest->isOverdue())
                        <span class="rounded-full border border-red-300/40 bg-red-500/15 px-2.5 py-1 text-xs font-bold text-red-100">Overdue</span>
                    @endif
                    <span class="rounded-full border px-2.5 py-1 text-xs font-bold {{ $difficultyClasses[$quest->difficulty] }}">
                        {{ $difficulties[$quest->difficulty] }}
                    </span>
                    <span class="rounded-full border border-white/10 bg-white/10 px-2.5 py-1 text-xs font-bold text-slate-200">
                        {{ $statuses[$quest->status] }}
                    </span>
                </div>

                <div class="mt-6 max-w-none">
                    <p class="whitespace-pre-line text-slate-300">{{ $quest->description ?: 'No briefing provided for this quest.' }}</p>
                </div>
            </section>

            <aside class="space-y-4">
                <div class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-5 shadow-xl shadow-purple-950/20">
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-amber-300">Reward</p>
                    <p class="mt-2 text-4xl font-black text-amber-200">{{ $quest->reward_exp }}</p>
                    <p class="text-sm text-slate-400">EXP</p>
                </div>
                <div class="rounded-lg border border-white/10 bg-[#1E293B]/70 p-5 shadow-xl shadow-purple-950/20">
                    <dl class="space-y-4 text-sm">
                        <div>
                            <dt class="font-bold uppercase tracking-wide text-slate-500">Category</dt>
                            <dd class="mt-1 text-slate-200">{{ $quest->category?->name ?? 'Uncategorized' }}</dd>
                        </div>
                        <div>
                            <dt class="font-bold uppercase tracking-wide text-slate-500">Deadline</dt>
                            <dd class="mt-1 text-slate-200">{{ $quest->deadline ? $quest->deadline->format('M d, Y H:i') : 'No deadline' }}</dd>
                        </div>
                        <div>
                            <dt class="font-bold uppercase tracking-wide text-slate-500">Completed at</dt>
                            <dd class="mt-1 text-slate-200">{{ $quest->completed_at ? $quest->completed_at->format('M d, Y H:i') : '-' }}</dd>
                        </div>
                    </dl>
                </div>
                <form method="POST" action="{{ route('quests.destroy', $quest) }}" onsubmit="return confirm('Delete this quest?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full rounded-md border border-red-300/30 bg-red-500/10 px-4 py-2.5 text-sm font-bold text-red-100 transition hover:bg-red-500/20">
                        Delete Quest
                    </button>
                </form>
            </aside>
        </div>
    </div>
</x-app-layout>
