<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="qb-section-kicker">Ranked by Valor</p>
                <h1 class="mt-2 qb-heading text-3xl sm:text-4xl">Hall of Heroes</h1>
                <p class="mt-2 max-w-2xl text-base text-slate-400">The most legendary adventurers, ranked by level, completed quests, and accumulated EXP.</p>
            </div>
            <span class="rounded-full border border-border bg-panel/70 px-4 py-2 text-sm font-bold text-slate-300">Top {{ $leaders->count() }}</span>
        </div>
    </x-slot>

    <div class="qb-page-shell">
        <div class="space-y-8">
            @if ($leaders->isNotEmpty())
                @php
                    $first = $leaders->get(0);
                    $second = $leaders->get(1);
                    $third = $leaders->get(2);
                @endphp

                <section class="grid gap-5 lg:grid-cols-3 lg:items-end">
                    <x-leaderboard-podium :leader="$second" :rank="2" class="lg:order-1" />
                    <x-leaderboard-podium :leader="$first" :rank="1" class="lg:order-2" />
                    <x-leaderboard-podium :leader="$third" :rank="3" class="lg:order-3" />
                </section>

                <section class="qb-panel overflow-hidden">
                    <div class="border-b border-border bg-[#15111d] px-5 py-4">
                        <p class="qb-section-kicker">Hero Roster</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-border text-left text-sm">
                            <thead class="bg-panel/80 text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">
                                <tr>
                                    <th class="px-5 py-4">Rank</th>
                                    <th class="px-5 py-4">Adventurer</th>
                                    <th class="px-5 py-4">Level</th>
                                    <th class="px-5 py-4">Completed Quests</th>
                                    <th class="px-5 py-4 text-right">Total EXP</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border/80">
                                @foreach ($leaders as $leader)
                                    <tr class="bg-card/55 transition hover:bg-violet/10">
                                        <td class="px-5 py-4 font-display text-xl font-bold text-royal">#{{ $loop->iteration }}</td>
                                        <td class="px-5 py-4">
                                            <div class="flex items-center gap-3">
                                                <x-adventurer-avatar :user="$leader" size="sm" />
                                                <div>
                                                    <p class="font-display text-lg font-bold text-white">{{ $leader->name }}</p>
                                                    <p class="text-xs text-slate-500">Adventurer</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="rounded-full border border-frost/30 bg-frost/10 px-3 py-1 font-bold text-sky-100">{{ $leader->level }}</span>
                                        </td>
                                        <td class="px-5 py-4 font-semibold text-slate-200">{{ $leader->completed_quests_count }}</td>
                                        <td class="px-5 py-4 text-right font-display text-lg font-bold text-violet-100">{{ number_format($leader->total_exp) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            @else
                <section class="rounded-lg border border-dashed border-border bg-panel/40 p-12 text-center">
                    <p class="font-display text-3xl font-bold text-white">No heroes have entered the hall yet.</p>
                    <p class="mt-2 text-sm text-slate-500">Complete quests to earn EXP and claim a rank.</p>
                </section>
            @endif
        </div>
    </div>
</x-app-layout>
