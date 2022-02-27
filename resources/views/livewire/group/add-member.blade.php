
<form method="POST" wire:submit.prevent="save">
    <div class="py-6 grid grid-cols-1 gap-y-6">

        <x-form.input.text
            :errors="$errors"
            name="newMember.name"
            wire:model="newMember.name"
            label="Name"
            placeholder="Name"
        />

        <x-form.input.text
            name="newMember.email"
            type="email"
            wire:model="newMember.email"
            label="Email"
            placeholder="email@address.com"
        />

        <div>
            <x-form.input.button type="submit">Add Member</x-form.input.button>
        </div>
    </div>
</form>
