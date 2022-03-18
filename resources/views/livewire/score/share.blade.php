<div class="flex justify-between py-2">
    <div>
        <x-score.share-facebook-button
            :score="$score"
            :confirm="!$score->user->public_profile"
        />
    </div>
    <div>
        <x-score.copy-button
            title="Copy"
            class="px-1.5 py-1 text-xs text-gray-400 rounded border border-gray-200 hover:border-wordle-yellow hover:text-wordle-yellow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
            :score="$score"
        />
    </div>
</div>
