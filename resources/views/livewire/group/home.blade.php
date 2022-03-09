<x-layout.page-container
    :heading="$group->name"
    :title="$group->name . ' Wordle Group'"
>
    @if($group->admin_user_id === $user->id)
    <x-slot name="captionSlot">
        <div class="flex justify-center mt-4">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Admin</span>
        </div>
    </x-slot>
    @endif

    <x-account.home-layout :page="'group.' . $group->id ">

        <div class="grid grid-cols-1 gap-y-12 divide-gray-200 divide-y">

            <div>
                <x-layout.sub-heading class="text-center">Leaderboard</x-layout.sub-heading>
                <div class="mt-8">
                    @if($group->scores->isNotEmpty())
                        <x-group.leaderboard :group="$group"/>
                    @else
                        <div class="text-gray-500 text-sm text-center">No one has recorded any scores. Invite some users
                            below!
                        </div>
                    @endif
                </div>
            </div>
            @if($memberOfGroup)
                @unless($user->dismissed_email_notification)
                    <div class="pt-8">
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
                    <x-layout.sub-heading class="text-center">Record A Score</x-layout.sub-heading>
                    @if($user->daily_scores_recorded === 0)
                        <div class="text-gray-600 text-sm text-center mt-4">
                            <p>
                                You have not yet recorded any scores.
                            </p>
                            <p class="mt-4">
                                To get started, just paste your board in the below text box.
                            </p>
                        </div>
                    @endif
                    <div class="mt-4">
                        <livewire:score.record-form :quick="true" :user="$user"/>
                    </div>
                    @if($user->dismissed_email_notification)
                        <div class="mt-8 text-center text-xs text-gray-500">
                            <p>
                                You can email your scores to <a class="link" href="mailto:scores@wordlegroup.com">scores@wordlegroup.com</a>.
                                <a href="/email/WordleGroup.vcf" role="button" class="link">Add Wordle Group to your
                                    contacts</a>.
                            </p>
                        </div>
                    @endif
                </div>
                @if($group->scores->isNotEmpty())
                    <div class="pt-8">
                        <x-layout.sub-heading class="text-center">Group Activity</x-layout.sub-heading>
                        <div class="mt-8">

                            <livewire:group.activity-feed :group="$group"/>
                        </div>
                    </div>
                @endif
                <div class="pt-8">
                    <x-layout.sub-heading class="text-center">Invite Someone to
                        Join {{ $group->name }}</x-layout.sub-heading>
                    <div class="mt-8 w-full flex justify-center">
                        <div class="w-72">
                            <livewire:group.invite-member :group="$group"/>
                        </div>
                    </div>
                </div>
            @endif


        </div>
    </x-account.home-layout>

</x-layout.page-container>
