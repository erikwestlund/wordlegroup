<button
    {{ $attributes->merge(['type' => 'button', 'title' => 'Share on Facebook']) }}
    x-data
    @click="window.open('https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('account.home')) }}', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600')"
>
    <x-icon-brands.facebook-f class="w-3 h-3" />
</button>
