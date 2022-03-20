<x-layout.page-container title="Wordle Group - Keep Score With Friends" :top-padding="false">
    <x-layout.social-meta
        title="Wordle Group - Keep Score With Friends"
        :url="route('home')"
        description="A free and easy to keep score with friends when playing Wordle. Create a group, invite friends, and see who climbs the leaderboard each day."
    />
    <div class="w-full mt-2">
        <div>
            <div>
                <div>
                    <span
                        class="rounded bg-white border border-transparent bg-wordle-yellow  px-2.5 py-1 text-xs font-semibold text-white tracking-wide uppercase"
                    >Already signed up?</span>
                    <span class="inline-flex items-center text-sm font-medium text-gray-600 ml-4">
                    <a class="text-gray-600 hover:underline" href="{{ route('login') }}">Click here to log in.</a>
                    </span>
                </div>
                <div class="mt-6 sm:max-w-xl">
                    <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">Play Wordle With Friends</h1>
                    <p class="mt-6 text-lg text-gray-500">Every day you text your group chat your score.</p>
                    <p class="mt-4 text-lg text-gray-500">Now it's free and easy to keep score. All you need to do is click Share on your Wordle Board, select your email client, and email your board to <a class="link" href="mailto:scores@wordlegroup.com">scores@wordlegroup.com</a>. We'll do the rest.</p>
                    <p class="mt-4 text-lg text-gray-500">To get started, just enter a name for your new group and your email.</p>
                </div>
                <x-layout.hr class="my-8" />

                <x-layout.sub-heading text-color="text-green-700">Create A Group</x-layout.sub-heading>

                <livewire:group.create-form :autofocus="false" />

            </div>
        </div>
    </div>
</x-layout.page-container>
