<x-layout.page-container heading="User Verification Failed" title="User Verification Failed" heading-text-color="text-red-600">

    <div class="mt-8 text-center text-sm text-gray-600">
        We could not verify your user email.
    </div>

    <div class="mt-8 flex items-center justify-center">
        <livewire:account.send-verification-email :user="$user" />
    </div>
</x-layout.page-container>
