<div>
    <ul role="list" class="divide-y divide-gray-200">
        @foreach($scores as $score)
            <li class="py-4">
                <div class="flex space-x-3">
                    <div class="w-8 h-8 rounded-full bg-wordle-yellow text-white inline-flex justify-center items-center">
                        {{ substr($score->user->name, 0, 1)  }}
                    </div>
                    <div class="flex-1 space-y-1">
                        <div class="flex items-start justify-between">
                            <div class="pr-4">
                                <h3 class="text-sm font-medium">
                                    @if($anonymizePrivateUsers && $score->user->private_profile) Anonymous User @else {{ $score->user->name }} @endif
                                </h3>
                                <p class="text-sm text-gray-500">Recorded
                                    a <span class="font-semibold">
                                        {{ $score->score === 7 ? 'X' : $score->score }}/6{{ $score->hard_mode ? '*' : '' }}
                                    </span>
                                     on <span class="font-semibold">Wordle {{ $score->board_number }}</span>.
                                </p>
                                <p class="text-sm text-gray-400">{{ $score->created_at->diffForHumans() }}</p>

                            </div>
                            <div class="font-system whitespace-pre text-xs">{{ $score->board }}

                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="flex justify-center mt-8">
        {{ $scores->onEachSide(1)->links() }}
    </div>
</div>
