<button
    {{ $attributes->merge(['type' => 'button']) }}
    @if($buttonClass)
    class="{{ $buttonClass }}"
    @else
    class="px-1 py-1 mr-2 text-xs text-gray-400 rounded border border-gray-200 last:mr-0 hover:border-wordle-yellow hover:text-wordle-yellow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
    @endif
    x-data="{
        text: '{{ json_encode($score->boardShareTextWithUrl, JSON_HEX_APOS) }}'
    }"
    @click="copyToClipboard(text.replaceAll('&quot;', ''))"
>
    @include('scripts.copy-to-clipboard')
    @if($useIcon)
    <x-icon-solid.scissors :class="'w-' . $iconSize . ' ' . 'h-'. $iconSize" />
    @else
    Copy
    @endif
</button>
