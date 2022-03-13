<x-layout.page-container :heading="$user->name" title="Wordle Group Account">

    <x-account.home-layout page="home">

        <div class="grid grid-cols-1 gap-y-12 divide-gray-200 divide-y">

            @if($user->pendingGroupInvitations->isNotEmpty())
                <div>
                    <x-layout.sub-heading class="text-center">Pending Group Invitations</x-layout.sub-heading>
                    <div class="mt-8">
                        <livewire:account.pending-group-invitations :user="$user"/>
                    </div>
                </div>
            @endif

            @if($user->daily_scores_recorded > 0)
                <div @if($user->pendingGroupInvitations->isNotEmpty()) class="pt-8" @endif>
                    <x-layout.sub-heading class="text-center">My Stats</x-layout.sub-heading>
                    <div class="mt-8">
                        <x-account.stats :user="$user"/>
                    </div>
                </div>
            @endif
            @if($user->public_profile)
                <div class="pt-8">
                    <x-layout.sub-heading class="text-center">Share</x-layout.sub-heading>
                    <x-account.share-links :user="$user" class="mt-6" />
                </div>
            @endif
            @unless($user->dismissed_email_notification)
                <div @if($user->daily_scores_recorded > 0) class="pt-8" @endif>
                    <x-layout.sub-heading class="text-center">Email Your Scores</x-layout.sub-heading>
                    <x-score.email-prompt class="text-gray-600 text-sm text-center mt-4"/>
                    <div class="mt-6 flex justify-center">
                        <livewire:score.dismiss-email-prompt-notification
                            :user="$user"
                            class="text-xs text-gray-600 hover:text-gray-800"
                        />
                    </div>
                </div>
            @endunless

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
                <x-layout.sub-heading class="text-center">Record A Score</x-layout.sub-heading>
                @if($user->daily_scores_recorded === 0)
                    <div class="text-gray-600 text-sm text-center mt-4">
                        <p>
                            You have not yet recorded any scores.
                        </p>
                        <p class="mt-4">
                            Don't have your board? <a
                                class="link" href="{{ route('account.record-score') }}"
                            >Click here to enter your score manually.</a>
                        </p>
                    </div>
                @endif
                <div class="mt-4">
                    <livewire:score.record-form :quick="true" :user="$user" :hide-email="true"/>
                    @if($user->dismissed_email_notification)
                        <div class="mt-8 text-center text-xs text-gray-500">
                            <x-account.email-scores-message/>
                        </div>
                    @endif
                </div>
            </div>

            <div class="pt-8">

                <x-layout.sub-heading class="text-center">My Scores</x-layout.sub-heading>
                <div class="mt-8">
                    <livewire:account.score-feed :user="$user" :show-when-recorded-by-other-user="true"/>
                </div>
            </div>

        </div>
    </x-account.home-layout>

</x-layout.page-container>
