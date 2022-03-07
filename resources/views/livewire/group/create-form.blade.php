<form wire:submit.prevent="store">
    <div class="mt-4 py-8 grid grid-cols-1 gap-y-8">
        <x-form.input.text
            wire:model.lazy="groupName"
            :autofocus="$autofocus"
            name="groupName"
            :errors="$errors"
            label="Group Name"
            placeholder="My Group"
        />
        @unless(Auth::check())
            <x-form.input.text
                wire:model.lazy="email"
                name="email"
                :errors="$errors"
                type="email"
                label="Email Address"
                placeholder="my@email.com"
            />
            <x-form.input.text
                wire:model="userName" name="groupName" :errors="$errors" label="Your Name" placeholder="Your Name"
            />
        @endunless
    </div>
    <x-form.input.button loading-action="store" class="w-24">Create</x-form.input.button>
</form>