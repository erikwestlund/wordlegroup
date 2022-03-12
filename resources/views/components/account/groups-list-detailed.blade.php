<div class="overflow-hidden">
    <ul role="list" class="divide-y divide-gray-200">
        @foreach($user->memberships as $membership)
            <li>
                <a
                    href="{{ route('group.home', $membership->group) }}"
                    class="block hover:bg-gray-50"
                    x-data="{hover: false}"
                    @mouseover="hover = true"
                    @mouseout="hover = false"
                >
                    <div class="flex items-center px-2 py-4 sm:px-2">
                        <div class="min-w-0 flex-1 flex justify-start">
                            <div
                                class="flex-shrink-0 flex items-center font-semibold text-2xl justify-center rounded-full w-12 h-12 bg-wordle-yellow text-white"
                                :class="{ 'bg-green-700': hover, 'bg-wordle-yellow':  !hover}"
                            >
                                {{ substr($membership->group->name, 0, 1)  }}
                            </div>
                            <div class="flex-grow">
                                <div class="px-4 flex items-center">
                                    <p class="text-lg font-bold  text-green-700 truncate">{{ $membership->group->name }}</p>
                                    @if($membership->group->isAdmin($user))
                                        <div class="px-4">
                                            <x-group.admin-badge text-size="text-xs" />
                                        </div>
                                    @endif
                                </div>

                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                    <div>
                                        <p class="flex items-center text-sm text-gray-500 font-medium">
                                            <span
                                                class="truncate"
                                            >{{ $membership->group->member_count }} {{ Str::plural('Member', $membership->group->member_count) }}</span>
                                        </p>
                                        <p class="mt-1 flex items-center text-sm text-gray-500">
                                            Joined {{ $membership->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div class="mt-1 md:mt-0">
                                        <div>
                                            @if($membership->group->scores_recorded > 0)
                                                <p class="flex items-center text-sm text-gray-500 md:font-medium">
                                                    Leader: {{ $membership->group->leaderboard->first()['name'] }}, {{ number_format($membership->group->leaderboard->first()['stats']['mean'], 2) }}
                                                </p>
                                                <p class="mt-1 flex items-center text-sm text-gray-500">
                                                    Average
                                                    Score: {{ $membership->group->score_mean }}
                                                </p>
                                            @else
                                                <p class="mt-1 flex items-center text-sm text-gray-500">
                                                    No scores recorded.
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div>
                            <x-icon-regular.chevron-right class="h-4 w-4 fill-gray-400"/>
                        </div>
                    </div>

                </a>
            </li>
        @endforeach
    </ul>
</div>
