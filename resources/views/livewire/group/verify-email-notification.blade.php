<x-layout.page-container heading="Check Your Email" title="Verify Your Email">

    <div class="rounded border-green-800 text-green-800 bg-green-50 border p-4 text-sm">
        <p>We have sent you a link to verify your email address.</p>

        <p class="mt-6">When you have verified your email address, you can start inviting members to your group.</p>

        <p class="mt-6 font-semibold">If you do not verify this group within {{ $expiresMinutes }} minutes, it will be removed.</p>
    </div>

    <x-layout.sub-heading class="mt-12">Didn't Get An Email?</x-layout.sub-heading>

    <div class="mt-8">
        <livewire:group.send-verification-email :group="$group" />
    </div>
</x-layout.page-container>
