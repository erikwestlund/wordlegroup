<x-layout.page-container :title="$user->name . '\'s Wordle Group Profile'" :heading="$user->name">
    <x-layout.social-meta
        title="Wordle Stats For {{ $user->name }}"
        url="{{ route('account.profile', $user) }}"
        description="Wordle Group is a way to keep score with a group of friends and track your Wordle performance over time."
    />

    <div class="grid grid-cols-1 gap-y-8 divide-y divide-gray-200">

        <div>
            <x-layout.sub-heading class="text-center">Stats</x-layout.sub-heading>
            <div class="mt-8">
                <x-account.stats :user="$user"/>
            </div>
        </div>

        <div class="pt-8">

            <x-layout.sub-heading class="text-center">Scores</x-layout.sub-heading>
            <div class="mt-8">
                <livewire:account.score-feed :user="$user"/>
            </div>
        </div>

        <div class="pt-8">

            <x-layout.sub-heading class="text-center">Groups</x-layout.sub-heading>
            <div class="mt-8">
                <x-account.groups-list :user="$user" :anonymize-private-groups="true"/>
            </div>
        </div>
    </div>

</x-layout.page-container>
