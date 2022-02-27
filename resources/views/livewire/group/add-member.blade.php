
<form method="POST" wire:submit.prevent="save">
    <div class="grid grid-cols-1 gap-y-6">

        <x-form.input.text
            :errors="$errors"
            name="name"
            wire:model="name"
            label="Name"
            placeholder="Name"
        />

        <x-form.input.text
            :errors="$errors"
            name="email"
            type="email"
            wire:model="email"
            label="Email"
            placeholder="email@address.com"
        />

        <div>
            <x-form.input.button type="submit">Add Member</x-form.input.button>
        </div>
    </div>
</form>
