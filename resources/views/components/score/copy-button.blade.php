<button
    {{ $attributes->merge(['type' => 'button']) }}
    x-data="{
        text: '{{ json_encode($score->boardShareText, JSON_HEX_APOS) }}'
    }"
    @click="copyToClipboard(text.replaceAll('&quot;', ''))"
>
    @include('scripts.copy-to-clipboard')
    Copy
</button>
