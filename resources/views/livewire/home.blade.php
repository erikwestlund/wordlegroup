<x-layout.page-container title="Wordle Group | Keep Score With Friends" :top-padding="false">
    <div class="w-full mt-2">
        <div>
            <div>
                <div>
                    <span
                        class="rounded bg-white border border-green-600  px-2.5 py-1 text-xs font-semibold text-green-600 tracking-wide uppercase"
                    >What's new?</span>
                    <span class="inline-flex items-center text-sm font-medium text-gray-600 ml-4">
                    <span>We just launched!</span>
                    </span>
                </div>
                <div class="mt-6 sm:max-w-xl">
                    <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">Play Wordle With Friends</h1>
                    <p class="mt-6 text-lg text-gray-500">Every day you text your group chat your score.</p>
                    <p class="mt-4 text-lg text-gray-500">Now it's free and easy to keep score in a friendly way.</p>
                    <p class="mt-4 text-lg text-gray-500">To get started, just enter a name for your new group and your email.</p>
                </div>
                <x-layout.hr class="my-8" />

                <x-layout.sub-heading text-color="text-green-700">Create A Group</x-layout.sub-heading>

                <livewire:group.create-form :autofocus="true" />

            </div>
        </div>
    </div>
</x-layout.page-container>
