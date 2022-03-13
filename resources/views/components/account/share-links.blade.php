<div {{ $attributes }}>
    @include('scripts.copy-to-clipboard')
    <div
        x-data
        class="flex justify-center items-center"
    >
        <div class="flex">
            <div class="grid grid-cols-1 gap-y-4 mr-8 last:mr-0">
                <div class="flex justify-center items-center">
                    <button
                        @click="copyToClipboard('{{ route('account.profile', $user) }}')"
                        class="w-10 h-10 inline-flex items-center justify-center bg-wordle-yellow hover:bg-green-700 rounded-full text-white hover:text-green-50"
                    >
                        <x-icon-solid.link class="h-5 w-5"/>
                    </button>
                </div>
                <div class="text-center">
                    <button
                        @click="copyToClipboard('{{ route('account.profile', $user) }}')"
                        type="button"
                        class="text-gray-500 text-xs"
                    >Copy Link
                    </button>
                </div>
            </div>


            <div class="grid grid-cols-1 gap-y-4 mr-8 last:mr-0">
                <div class="flex justify-center items-center">
                    <button
                        @click="window.open('https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('account.profile', $user)) }}', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600')"
                        class="w-10 h-10 inline-flex items-center justify-center bg-wordle-yellow hover:bg-green-700 rounded-full text-white hover:text-green-50"
                    >
                        <x-icon-brands.facebook-f class="h-5 w-5"/>
                    </button>
                </div>
                <div class="text-center">
                    <button
                        @click="window.open('https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('account.profile', $user)) }}', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600')"
                        type="button"
                        class="text-gray-500 text-xs"
                    >Facebook
                    </button>
                </div>
            </div>


            <div class="grid grid-cols-1 gap-y-4 mr-8 last:mr-0">
                <div class="flex justify-center items-center">
                    <button
                        @click="window.open('https://twitter.com/share?url={{ urlencode(route('account.profile', $user)) }}&via=wordlegroup&text={{ urlencode('View my Wordle Stats on Wordle Group') }}.', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600')"
                        class="w-10 h-10 inline-flex items-center justify-center bg-wordle-yellow hover:bg-green-700 rounded-full text-white hover:text-green-50"
                    >
                        <x-icon-brands.twitter class="h-5 w-5"/>
                    </button>
                </div>
                <div class="text-center">
                    <button
                        @click="window.open('https://twitter.com/share?url={{ urlencode(route('account.profile', $user)) }}&via=wordlegroup&text={{ urlencode('View my Wordle Stats on Wordle Group') }}.', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600')"
                        type="button"
                        class="text-gray-500 text-xs"
                    >Twitter
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
