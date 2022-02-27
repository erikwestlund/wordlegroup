<div>
    <x-layout.centered-header>{{ $group->name }}</x-layout.centered-header>

    <div class="mx-auto w-full max-w-lg mt-8">

        <div class="grid grid-cols-1 gap-y-8">
            <div class="col-span-1">
                <h2 class="text-indigo-700 text-lg font-semibold">Add Member</h2>

                <form method="POST" wire:submit.prevent="rename">
                    <div class="py-6 grid grid-cols-1 gap-y-4">
                        <x-form.input.text
                            name="newMemberName"
                            wire:model="new.name"
                            label="Group Name"
                            placeholder="Group Name"
                        />

                        <div>
                            <x-form.input.button type="submit">Submit</x-form.input.button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-span-1">
                <h2 class="text-indigo-700 text-lg font-semibold">Manage Members</h2>
            </div>

            <div class="col-span-1">
                <h2 class="text-indigo-700 text-lg font-semibold">Rename Group</h2>

                <form method="POST" wire:submit.prevent="rename">
                    <div class="py-6 grid grid-cols-1 gap-y-4">
                        <x-form.input.text
                          name="groupName"
                          wire:model="group.name"
                          label="Group Name"
                          placeholder="Group Name"
                        />

                        <div>
                            <x-form.input.button type="submit">Submit</x-form.input.button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
