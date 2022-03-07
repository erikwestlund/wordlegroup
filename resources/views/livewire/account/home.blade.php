<x-layout.page-container :heading="$user->name" title="Account Home">

    <x-account.home-layout page="home">

        <div class="grid grid-cols-1 gap-y-12 divide-gray-200 divide-y">

            @if($user->daily_scores_recorded > 0)
                <div>
                    <x-layout.sub-heading class="text-center">My Stats</x-layout.sub-heading>
                    <div class="mt-8">
                        <x-account.stats :user="$user"/>
                    </div>
                </div>
            @endif

            <div @if($user->daily_scores_recorded > 0) class="pt-8" @endif>
                <x-layout.sub-heading class="text-center">Record A Score</x-layout.sub-heading>
                @if($user->daily_scores_recorded === 0)
                <div class="text-gray-600 text-sm text-center mt-4">
                    <p>
                        You have not yet recorded any scores.
                    </p>
                    <p class="mt-4">
                        To get started, just paste your board in the below textbox.
                    </p>
                    <p class="mt-4">
                        Don't have your board? <a
                            class="text-green-700 hover:underline" href="{{ route('account.record-score') }}"
                        >Click here to enter your score manually.</a>
                    </p>
                </div>
                @endif
                <div class="mt-4">
                    <livewire:score.record-form :quick="true" :user="$user"/>
                </div>
            </div>

            <div class="pt-8">
                <x-layout.sub-heading class="text-center">My Groups</x-layout.sub-heading>
                <div class="mt-8">
                    <x-account.groups-list :user="$user"/>
                </div>
                <div class="mt-8 text-center">
                    <a
                        class="text-sm inline-flex items-center rounded-lg bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 px-4 py-2"
                        href="{{ route('group.create') }}"
                    >
                        <x-icon-regular.plus class="h-3 w-3 mr-1.5 fill-gray-500"/>
                        Create A New Group</a>
                </div>
            </div>

            <div class="pt-8">

                <x-layout.sub-heading class="text-center">My Scores</x-layout.sub-heading>
                <div class="mt-8">
                    <livewire:account.score-feed :user="$user"/>
                </div>
            </div>

        </div>
    </x-account.home-layout>

</x-layout.page-container>
