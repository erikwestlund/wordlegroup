<button
    {{ $attributes->merge(['type' => 'button']) }}
    @if($buttonClass)
    class="{{ $buttonClass }}"
    @endif
    x-data="{
        text: '{{ json_encode($score->boardShareTextWithUrl, JSON_HEX_APOS) }}'
    }"
    @click="copyToClipboard(text.replaceAll('&quot;', ''))"
>
    @include('scripts.copy-to-clipboard')
    Copy
</button>
