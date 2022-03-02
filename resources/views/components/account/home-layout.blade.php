<div>

    <div class="flex justify-center">
        <x-account.nav :active-page="$page" />
    </div>

    <x-layout.hr class="my-8" />

    <div class="flex-grow">
        {{ $slot }}
    </div>
</div>
