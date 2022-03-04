<div>
    <ul role="list" class="divide-y divide-gray-200">
        @foreach($scores as $score)
            <li class="py-4">
                <div class="flex space-x-3">
                    <x-score.display :score="$score"/>
                </div>
            </li>
        @endforeach
    </ul>
    <div>
        {{ $scores->links() }}
    </div>
</div>
