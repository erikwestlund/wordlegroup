<x-layout.page-container :heading="$user->name" title="Account Home">

    <x-account.home-layout page="home">
        <livewire:account.score-feed :user="$user" />
    </x-account.home-layout>

</x-layout.page-container>
