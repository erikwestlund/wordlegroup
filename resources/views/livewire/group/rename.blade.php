<form method="POST" wire:submit.prevent="update">
    <div class="py-6 grid grid-cols-1 gap-y-4">

        <x-form.input.text
            :errors="$errors"
            name="group.name"
            wire:model="group.name"
            label="Group Name"
            placeholder="Group Name"
        />

        <div>
            <x-form.input.button type="submit">Save</x-form.input.button>
        </div>
    </div>
</form>
