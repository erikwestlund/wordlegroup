<x-layout.page-container :heading="'Join ' . $invitation->group->name" :title="'Join ' . $invitation->group->name">
    <div class="flex justify-center">
        <div class="w-full max-w-sm">

            <div class="text-gray-600 pb-8 text-sm">
                <p>
                    {{ $invitation->invitingUser->name }} has invited you to join the Wordle Group <span class="font-semibold">{{ $invitation->group->name }}</span>.
                </p>
                <p class="mt-4">
                    Just click "Join Group" below. Good luck!
                </p>
            </div>

            <form class="mb-0" method="post" wire:submit.prevent="accept">
                <div class="grid grid-cols-1 gap-y-6">
                    <div class="col-span-1">
                        <x-form.input.text
                            :errors="$errors"
                            name="name"
                            autofocus
                            label="Your Name"
                            placeholder="Jane Doe"
                            wire:model.lazy="name"
                        />
                    </div>


                    <div class="col-span-1 flex justify-center">
                        <x-form.input.button loading-action="accept" class="w-36">
                            Join Group
                        </x-form.input.button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout.page-container>
