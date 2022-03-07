<div  @if($user->memberships->count() <= 1) class="flex justify-center" @endif>
    <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 @if($user->memberships()->count() > 1) sm:grid-cols-2 @else flex justify-center @endif">
        @foreach($user->memberships as $membership)
            <li class="col-span-1 flex shadow-sm rounded-md @if($user->memberships->count() <= 1) justify-center w-80 @endif">
                <a
                    href="{{ route('group.home', $membership->group) }}"
                    class="flex flex-grow"
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
                                class="text-gray-900 font-medium"
                            >{{ $membership->group->name }}</span>
                            <p class="text-gray-500">{{ $membership->group->member_count }} {{ Str::plural('Member', $membership->group->member_count) }}@if($membership->group->leaderboard && isset($membership->group->leaderboard->first()['name'])), Leader: {{ $membership->group->leaderboard->first()['name']  }}@endif</p>
                        </div>


                    </div>
                </a>
            </li>
        @endforeach

    </ul>
</div>