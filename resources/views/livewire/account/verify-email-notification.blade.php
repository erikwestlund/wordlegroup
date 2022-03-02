<x-layout.page-container heading="Check Your Email" title="Verify Your Email With Wordle Group">

    <div class="rounded border-green-800 text-green-800 bg-green-50 border p-4 text-sm">
        <p>We have sent you a link to verify your email address.</p>

        <p class="mt-6 text-red-600">If you do not verify your email address within {{ config('settings.unverified_user_expires_minutes') }} minutes, your account will be removed.</p>
    </div>

    <x-layout.sub-heading class="mt-12">Didn't Get An Email?</x-layout.sub-heading>

    <div class="mt-8">
        <livewire:account.send-verification-email :user="$user" />
    </div>
</x-layout.page-container>
