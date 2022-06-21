<x-layout.page-container
    :heading="$group->name"
    :title="$group->name . ' Wordle Group'"
>

    <x-layout.social-meta
        title="{{ $group->name }} - Wordle Group Leaderboard & Stats"
        :url="route('group.home', $group)"
        description="Wordle Group is a way to keep score with a group of friends and track your Wordle performance over time."
    />

    @if($isAdmin)
        <x-slot name="captionSlot">
            <div class="flex justify-center mt-4">
                <x-group.admin-badge/>
                <a
                    href="{{ route('group.settings', $group) }}"
                    class="ml-4 text-gray-500 hover:text-gray-600 text-sm inline-flex items-center"
                >
                    Group Settings
                </a>
            </div>
        </x-slot>
    @endif

    <x-account.home-layout :page="'group.' . $group->id ">

        <div class="grid grid-cols-1 gap-y-12 divide-gray-200 divide-y">

            @if($memberOfGroup && $memberCount === 1)
                <div>
                    <x-layout.sub-heading class="text-center">Invite Someone to
                        Join {{ $group->name }}</x-layout.sub-heading>
                    <div class="mt-8 w-full flex justify-center">
                        <div class="w-72">
                            <livewire:group.invite-member :group="$group"/>
                        </div>
                    </div>
                </div>
            @endif

            <div @if($memberOfGroup && $memberCount === 1) class="pt-8" @endif>
                @if($isAdmin && $group->pendingInvitations->isNotEmpty())
                    <div class="mb-8">
                        <x-layout.sub-heading class="text-center">Pending Group Invitations</x-layout.sub-heading>
                        <div class="mt-4">
                            <livewire:group.pending-invitations :group="$group"/>
                        </div>
                    </div>
                @endif


                <x-layout.sub-heading class="text-center">Leaderboard</x-layout.sub-heading>
                <div class="mt-8">

                    @if($group->scores->isNotEmpty())
                        <x-group.leaderboard-tabs
                            :group="$group"
                            :member-of-group="$memberOfGroup"
                            :anonymize-private-users="$group->public && !$memberOfGroup"
                        />
                    @else
                        <div class="text-gray-500 text-sm text-center">No one has recorded any scores. Invite some users
                            below!
                        </div>
                    @endif
                </div>

                @if($group->scores_recorded > 0)
                    <div class="pt-10">
                        <x-layout.sub-heading class="text-center">Group Stats</x-layout.sub-heading>
                        <div class="mt-8">
                            <x-group.stats :group="$group"/>
                        </div>
                    </div>
                @endif
            </div>
            @if($memberOfGroup)
                @if($group->public)
                <div class="pt-8">
                    <x-layout.sub-heading class="text-center">Share</x-layout.sub-heading>
                    <x-group.share-links :group="$group" class="mt-6" />
                </div>
                @endif
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
                        <livewire:score.record-form :quick="true" :user="$user" :group="$group" :hide-email="true"/>
                    </div>
                    @if($user->dismissed_email_notification)
                        <div class="mt-8 text-center text-xs text-gray-500">
                            <x-account.email-scores-message/>
                        </div>
                    @endif
                </div>
            @endif
            @if($group->scores_recorded > 0)
                <div class="pt-8">
                    <x-layout.sub-heading class="text-center">Group Activity</x-layout.sub-heading>
                    <div class="mt-8">

                        <livewire:group.activity-feed
                            :group="$group"
                            :anonymize-private-users="$group->public && !$memberOfGroup"
                        />
                    </div>
                </div>
            @endif

            @if($memberOfGroup)
                @if($memberCount > 1)
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

                <div class="pt-8">
                    <x-layout.sub-heading class="text-center">Group Members</x-layout.sub-heading>
                    <div class="mt-8 w-full flex justify-center">
                        <livewire:group.member-list :group="$group"/>
                    </div>
                </div>

            @endif


        </div>
    </x-account.home-layout>

</x-layout.page-container>
