<x-layout.page-container heading="Groups" title="Account Home">

    <x-account.home-layout page="groups">
        <x-account.groups-list :user="$user" />
    </x-account.home-layout>

</x-layout.page-container>
