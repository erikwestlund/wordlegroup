<x-layout.page-container heading="Group Not Verified" title="Group Not Verified">

    <div class="rounded border-red-800 text-red-800 bg-red-50 border p-4 text-sm">
        <p>This group has not been verified.</p>

        <p class="mt-6">Check your email for a group verification request.</p>

        <p class="mt-6">If this group is not verified within {{ $expiresMinutes }} minutes, it will be removed.</p>
    </div>

    <x-layout.sub-heading class="mt-12">Can't Find The Verification Email?</x-layout.sub-heading>

    <div class="mt-8">
        <livewire:group.send-verification-email :group="$group" />
    </div>
</x-layout.page-container>
