<x-layout.page-container :heading="$user->name" title="Account Home">

    <x-account.home-layout page="home">

        <div class="grid grid-cols-1 gap-y-16">

            <div>
                <x-layout.sub-heading class="text-center">Stats</x-layout.sub-heading>
                <div class="mt-6">
                    <x-account.stats :user="$user"/>
                </div>
            </div>

            <div>
                <x-layout.sub-heading class="text-center">Scores</x-layout.sub-heading>
                <div class="mt-6">
                    <livewire:account.score-feed :user="$user"/>
                </div>
            </div>

        </div>
    </x-account.home-layout>

</x-layout.page-container>
