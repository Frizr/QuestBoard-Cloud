<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">Leaderboard</p>
            <h1 class="mt-2 text-2xl font-black text-white sm:text-3xl">Top adventurers</h1>
            <p class="mt-2 text-sm text-slate-400">Ranked by total EXP. Sensitive data such as email is hidden.</p>
        </div>
    </x-slot>

    <div class="px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl rounded-lg border border-white/10 bg-[#1E293B]/70 p-5 shadow-xl shadow-purple-950/20">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-white/10 text-left text-sm">
                    <thead class="text-xs font-bold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="py-3 pr-4">Rank</th>
                            <th class="px-4 py-3">User</th>
                            <th class="px-4 py-3">Level</th>
                            <th class="px-4 py-3">Completed</th>
                            <th class="py-3 pl-4 text-right">Total EXP</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse ($leaders as $index => $leader)
                            <tr class="transition hover:bg-white/[0.04]">
                                <td class="py-4 pr-4">
                                    <span class="grid h-9 w-9 place-items-center rounded-md border border-amber-300/30 bg-amber-300/10 font-black text-amber-200">
                                        {{ $index + 1 }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <p class="font-bold text-white">{{ $leader->name }}</p>
                                    <p class="text-xs text-slate-500">QuestBoard adventurer</p>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="rounded-full border border-purple-300/30 bg-purple-500/15 px-3 py-1 text-xs font-bold text-purple-100">
                                        Level {{ $leader->level }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-slate-300">{{ $leader->completed_quests_count }}</td>
                                <td class="py-4 pl-4 text-right text-lg font-black text-amber-200">{{ $leader->total_exp }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-10 text-center text-slate-500">No leaderboard data yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
