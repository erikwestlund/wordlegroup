<div class="flex justify-center" >
    <ul role="list" class="grid grid-cols-1 gap-5 sm:gap-6 w-full max-w-sm sm:max-w-md">
        @foreach($user->memberships as $membership)
            <li class="col-span-1 flex shadow-sm rounded-md justify-center ">
                <a
                    href="{{ route('group.home', $membership->group) }}"
                    class="flex flex-grow overflow-hidden"
                    x-data="{hover: false}"
                    @mouseover="hover = true"
                    @mouseout="hover = false"
                >
                    <div
                        class="flex-shrink-0 flex items-center bg-yellow-500 justify-center w-16 text-white text-2xl font-bold rounded-l-md"
                        :class="{ 'bg-green-700': hover, 'bg-yellow-500':  !hover}"
                    >
                        {{ substr($membership->group->name, 0, 1)  }}
                    </div>
                    <div
                        class="flex-grow flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate"
                    >
                        <div class="flex-1 px-4 py-2 text-sm truncate">
                            <span
                                class="text-gray-900 font-bold"
                            >{{ $membership->group->name }}</span>
                            <ul class="mt-0.5 text-sm">
                                @if($membership->group->leaderboard && isset($membership->group->leaderboard->first()['name']))
                                    <li>
                                        <span class="font-medium">Leader:</span>
                                        {{ $membership->group->leaderboard->first()['name']  }}, {{ number_format($membership->group->leaderboard->first()['stats']['mean'], 2) }}
                                    </li>
                                    <li>
                                        <span class="font-medium">Avg. Score:</span>
                                        {{ number_format($membership->group->score_mean, 2) }}
                                    </li>
                                    <li>
                                        <span class="font-medium">My Place:</span>
                                        {{ $membership->group->leaderboard->firstWhere('user_id', $user->id)['place'] }}/{{ $membership->group->leaderboard->pluck('place')->max() }}
                                    </li>
                                @endif
                            </ul>                        </div>


                    </div>
                </a>
            </li>
        @endforeach

    </ul>
</div>
