<button
    {{ $attributes->merge(['type' => 'button', 'title' => 'Share on Facebook']) }}
    @if($buttonClass)
    class="{{ $buttonClass }}"
    @else
    class="px-1 py-1 mr-2 text-xs text-gray-400 rounded border border-gray-200 last:mr-0 hover:border-wordle-yellow hover:text-wordle-yellow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
    @endif
    x-data
    @if($confirm)
    onclick="confirm('{{ $confirmMessage }}') || event.stopImmediatePropagation()"
    @endif
    wire:click="shareScore({{ $score->id }}, 'twitter')"
    x-on:shared-score-{{ $score->id }}-to-twitter.window="window.open('https://twitter.com/share?url={{ urlencode(route('score.share-page', $score)) }}&via=wordlegroup&text={{ $score->boardTitle  }} by {{ $score->user->name }}.', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600')"
>
    <x-icon-brands.twitter :class="'w-' . $iconSize . ' ' . 'h-'. $iconSize" />
</button>
