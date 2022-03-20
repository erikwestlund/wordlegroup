<div class="flex justify-between py-2">
    <div class="flex items-center">
        <div class="mr-1.5 last:mr-0">
            <x-score.share-link-button
                :score="$score"
                :confirm="!$score->user->public_profile && !$score->public"
            />
        </div>
        <div class="mr-1.5 last:mr-0">
            <x-score.share-facebook-button
                :score="$score"
                :confirm="!$score->user->public_profile && !$score->public"
            />
        </div>
        <div class="mr-1.5 last:mr-0">
            <x-score.share-twitter-button
                :score="$score"
                :confirm="!$score->user->public_profile && !$score->public"
            />
        </div>

    </div>
    <div>
        <x-score.copy-button
            title="Copy"
            class="px-1.5 py-1 text-xs text-gray-400 rounded border border-gray-200 hover:border-wordle-yellow hover:text-wordle-yellow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
            :score="$score"
        />
    </div>
</div>
