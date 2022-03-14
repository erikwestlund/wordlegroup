<div class="flex justify-between py-2">
    <div>
        @if(!$score->user->public_profile)
            <x-score.share-link-button
                class="px-1 py-1 mr-2 text-xs text-gray-400 rounded border border-gray-200 last:mr-0 hover:border-wordle-yellow hover:text-wordle-yellow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
                :score="$score"
                onclick="confirm('Your profile is set to private. Are you sure you want to this score visible to the public? Your profile will remain private.') || event.stopImmediatePropagation()"
                :wire:click="'makePublic(' . $score->id . ')'"
            />
        @else
            <x-score.share-link-button
                class="px-1 py-1 mr-2 text-xs text-gray-400 rounded border border-gray-200 last:mr-0 hover:border-wordle-yellow hover:text-wordle-yellow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
                :score="$score"
            />
        @endif
    </div>
    <div>
        <x-score.copy-button
            title="Copy"
            class="px-1.5 py-1 text-xs text-gray-400 rounded border border-gray-200 hover:border-wordle-yellow hover:text-wordle-yellow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
            :score="$score"
        />
    </div>
</div>
