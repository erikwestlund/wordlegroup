<x-layout.page-container heading="Settings" title="Wordle Group Account Settings">

    <x-account.home-layout page="settings">

        <form type="PATCH" class="mb-0 flex justify-center mx-auto" wire:submit.prevent="update">
            <div class="grid grid-cols-1 gap-y-6 w-80">
                <x-form.input.text
                    :errors="$errors"
                    name="user.name"
                    label="Name"
                    wire:model="user.name"
                    placeholder="Name"
                />

                <x-form.input.text
                    :errors="$errors"
                    type="email"
                    name="user.email"
                    label="Email Address"
                    wire:model="user.email"
                    placeholder="email@address.com"
                />

                <x-form.input.checkbox
                    name="publicProfile"
                    wire:model="user.public_profile"
                    label="Make my profile public."
                    tip="Allow others who are not members of your groups to see your scores."
                />

                <x-form.input.checkbox
                    name="allowDigestEmails"
                    wire:model="user.allow_digest_emails"
                    label="Receive weekly digest emails."
                    tip="We will send you an email once a week with a report on your scores and how you're doing in your groups."
                />

                <x-form.input.checkbox
                    name="allowReminderEmails"
                    wire:model="user.allow_reminder_emails"
                    label="Allow reminder emails."
                    tip="Let others in your group remind you to record your score. You'll never get more than one reminder email a day."
                />

                <div class="col-span-1">
                    <x-form.input.button type="submit" loading-action="update" class="w-20">Save</x-form.input.button>
                </div>
            </div>
        </form>
    </x-account.home-layout>

</x-layout.page-container>
