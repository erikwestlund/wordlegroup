<a
    role="button"
    {{ $attributes->merge(['title' => 'Copy Share Link']) }}
    @if($buttonClass)
    class="{{ $buttonClass }}"
    @else
    class="px-1 py-1 mr-2 text-xs text-gray-400 rounded border border-gray-200 last:mr-0 hover:border-wordle-yellow hover:text-wordle-yellow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
    @endif
    x-data
    @if($confirm)
    onclick="confirm('{{ $confirmMessage }}') || event.stopImmediatePropagation()"
    @endif
    wire:click.prevent="shareScore({{ $score->id }}, 'link')"
    x-on:shared-score-{{ $score->id }}-to-link.window="window.location.href = '{{ route('score.share-page', $score)  }}'"
    href="{{ route('score.share-page', $score) }}"
>
    @include('scripts.copy-to-clipboard')

    <x-icon-solid.link class="w-3.5 h-3.5" />
</a>
