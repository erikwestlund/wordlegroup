<div {{ $attributes }}>
    @include('scripts.copy-to-clipboard')
    <div
        x-data
        class="flex justify-center items-center"
    >
        <div class="flex">
            <div class="grid grid-cols-1 gap-y-4 mr-6 last:mr-0">
                <div class="flex justify-center items-center">
                    <button
                        @click="copyToClipboard('{{ route('group.home', $group) }}')"
                        class="w-10 h-10 inline-flex items-center justify-center bg-green-700 hover:bg-wordle-yellow rounded-full text-white hover:text-green-50"
                    >
                        <x-icon-solid.link class="h-5 w-5"/>
                    </button>
                </div>
                <div class="text-center">
                    <button
                        @click="copyToClipboard('{{ route('group.home', $group) }}')"
                        type="button"
                        class="text-gray-500 hover:text-gray-700 text-xs"
                    >Copy Link
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-y-4 mr-6 last:mr-0">
                <div class="flex justify-center items-center">
                    <a
                        href="mailto:?subject=Check out my Wordle Group&body=View the leaderboard and stats for my Wordle Group, {{ $group->name }}, at {{ route('group.home', $group) }}"
                        class="w-10 h-10 inline-flex items-center justify-center bg-green-700 hover:bg-wordle-yellow rounded-full text-white hover:text-green-50"
                    >
                        <x-icon-solid.envelope class="h-5 w-5"/>
                    </a>
                </div>
                <div class="text-center">
                    <a
                        href="mailto:?subject=Check out my Wordle Group&body=View the leaderboard and stats for my Wordle Group, {{ $group->name }}, at {{ route('group.home', $group) }}."
                        type="button"
                        class="text-gray-500 hover:text-gray-700 text-xs"
                    >Email
                    </a>
                </div>
            </div>


            <div class="grid grid-cols-1 gap-y-4 mr-6 last:mr-0">
                <div class="flex justify-center items-center">
                    <button
                        @click="window.open('https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('group.home', $group)) }}', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600')"
                        class="w-10 h-10 inline-flex items-center justify-center bg-green-700 hover:bg-wordle-yellow rounded-full text-white hover:text-green-50"
                    >
                        <x-icon-brands.facebook-f class="h-5 w-5"/>
                    </button>
                </div>
                <div class="text-center">
                    <button
                        @click="window.open('https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('group.home', $group)) }}', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600')"
                        type="button"
                        class="text-gray-500 hover:text-gray-700 text-xs"
                    >Facebook
                    </button>
                </div>
            </div>


            <div class="grid grid-cols-1 gap-y-4 mr-6 last:mr-0">
                <div class="flex justify-center items-center">
                    <button
                        @click="window.open('https://twitter.com/share?url={{ urlencode(route('group.home', $group)) }}&via=wordlegroup&text={{ urlencode('View the leaderboard and stats for my Wordle Group, ' . $group->name) }}.', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600')"
                        class="w-10 h-10 inline-flex items-center justify-center bg-green-700 hover:bg-wordle-yellow rounded-full text-white hover:text-green-50"
                    >
                        <x-icon-brands.twitter class="h-5 w-5"/>
                    </button>
                </div>
                <div class="text-center">
                    <button
                        @click="window.open('https://twitter.com/share?url={{ urlencode(route('group.home', $group)) }}&via=wordlegroup&text={{ urlencode('View the leaderboard and stats for my Wordle Group, ' . $group->name) }}.', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600')"
                        type="button"
                        class="text-gray-500 hover:text-gray-700 text-xs"
                    >Twitter
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
