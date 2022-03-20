<div>
    @if($isGroupMember)
        <div class="flex items-center justify-center mb-8">
            <div class="mr-4 w-16"></div>
            <div class="w-56">
                <x-group.user-select
                    :default-empty="true"
                    wire:model="filterByUserId"
                    name="activityUsers"
                    label="Filter By User"
                    :group="$group"
                />
            </div>

            @if($filterByUserId)
                <button
                    class="ml-4 text-sm w-16 px-4 py-2 text-gray-500 text-sm hover:text-gray-900 rounded focus:ring-2 focus:ring-offset-2 focus:ring-green-800"
                    type="button"
                    wire:click="clearUserFilter"
                    x-data
                    @click="$dispatch('cleared-activity-feed-filter')"
                >
                    Clear
                </button>
            @else
                <div class="mr-4 w-16"></div>

            @endif
        </div>
    @endif
    <ul role="list" class="divide-y divide-gray-200">
        @foreach($scores as $score)
            <li class="py-4 px-4 hover:bg-gray-50">
                <a href="{{ route('score.share-page', $score) }}" class="flex space-x-3">
                    <div
                        class="w-8 h-8 rounded-full bg-wordle-yellow text-white inline-flex justify-center items-center"
                    >
                        {{ substr($score->user->name, 0, 1)  }}
                    </div>
                    <div class="flex-1 space-y-1">
                        <div class="flex items-start justify-between">
                            <div class="pr-4">
                                <h3 class="text-sm font-medium">
                                    @if($anonymizePrivateUsers && $score->user->private_profile) Anonymous
                                    User @else {{ $score->user->name }} @endif
                                </h3>
                                <p class="text-sm text-gray-500">Recorded
                                    a <span class="font-semibold">
                                        {{ $score->score === 7 ? 'X' : $score->score }}/6{{ $score->hard_mode ? '*' : '' }}
                                    </span>
                                    on <span class="font-semibold">Wordle {{ $score->board_number }}</span>.
                                </p>
                                <p class="text-sm text-gray-400">{{ $score->created_at->diffForHumans() }}</p>

                            </div>


                            <div class="text-xs">
                                @if($score->boardCanBeSeenByUser($user))
                                <x-score.board :score="$score"/>
                                @else
                                <x-score.hidden-board :score="$score" />
                                <div class="text-center flex items-center justify-center text-gray-400 mt-1">
                                    <x-icon-solid.lock class="h-2.5 w-2.5 mr-1" />
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="flex justify-center mt-8">
        {{ $scores->onEachSide(1)->links() }}
    </div>
</div>
