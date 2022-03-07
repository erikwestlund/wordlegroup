<x-layout.page-container :heading="$group->name" :title="$group->name">

    <x-account.home-layout page="group">

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
                </div>
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
            @if($group->scores->isNotEmpty())

                <div class="pt-8">
                    <x-layout.sub-heading class="text-center">Activity</x-layout.sub-heading>
                    <div class="mt-8">

                        <livewire:group.activity-feed :group="$group"/>
                    </div>
                </div>

            @endif

        </div>
    </x-account.home-layout>

</x-layout.page-container>
