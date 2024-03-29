<div>
    @if($scores->isNotEmpty())
        <ul
            role="list" class="flex flex-wrap justify-center @if($scores->count() > 1) sm:justify-between @endif w-full"
        >
            @foreach($scores as $score)
                <li class="py-4 px-4 text-center">
                    <a href="{{ route('score.share-page', $score) }}">
                        <div class="space-x-3 w-56 border hover:border-wordle-yellow rounded-lg">
                            <x-score.display :score="$score"/>
                        </div>
                    </a>
                    @if($showWhenRecordedByOtherUser && ! $score->recordedByUser())
                        <div class="text-xs text-gray-400 mt-2">Recorded by {{ $score->recordingUser->name }}</div>
                    @endif
                    <livewire:score.share :icon-size="3" :score="$score" :key="$score->id" :confirm="true"/>
                </li>
            @endforeach
        </ul>
        <div class="flex justify-center mt-8">
            {{ $scores->links() }}
        </div>
    @else
        <p class="text-sm text-center text-gray-600">You have not recorded any scores. Get started using the above
            form.</p>
    @endif
</div>
