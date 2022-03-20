<div class="flex justify-between py-2">
    <div class="flex items-center">
        <div class="mr-1.5 last:mr-0">
            <x-score.share-link-button
                :score="$score"
                :button-class="$buttonClass"
                :confirm="$confirm"
                :icon-size="$iconSize"
            />
        </div>
        <div class="mr-1.5 last:mr-0">
            <x-score.share-facebook-button
                :score="$score"
                :button-class="$buttonClass"
                :confirm="$confirm"
                :icon-size="$iconSize"
            />
        </div>
        <div class="mr-1.5 last:mr-0">
            <x-score.share-twitter-button
                :score="$score"
                :button-class="$buttonClass"
                :confirm="$confirm"
                :icon-size="$iconSize"
            />
        </div>
        @if($showCopyButton && $groupCopyWithAllButtons)
        <div class="mr-1.5 last:mr-0">
            <x-score.copy-button
                title="Copy"
                :button-class="$buttonClass"
                :score="$score"
                :use-icon="$showCopyIcon"
                :confirm="$confirm"
                :icon-size="$iconSize"
            />
        </div>
        @endif

    </div>
    @if($showCopyButton && ! $groupCopyWithAllButtons)
    <div>
        <x-score.copy-button
            title="Copy"
            :button-class="$buttonClass"
            :score="$score"
            :use-icon="$showCopyIcon"
            :icon-size="$iconSize"
        />
    </div>
    @endif
</div>
