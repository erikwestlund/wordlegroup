<div>
    <ul role="list" class="flex flex-wrap justify-center sm:justify-between w-full">
        @foreach($scores as $score)
            <li class="py-4 px-4 text-center">
                <div class="space-x-3 w-56  border rounded-lg">
                    <x-score.display :score="$score"/>
                </div>
                @if(! $score->recordedByUser())
                    <div class="text-xs text-gray-400 mt-2">Recorded by {{ $score->recordingUser->name }}</div>
                @endif
            </li>
        @endforeach
    </ul>
    <div class="flex justify-center mt-8">
        {{ $scores->links() }}
    </div>
</div>