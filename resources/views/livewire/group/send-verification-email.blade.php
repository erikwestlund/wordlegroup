<form wire:submit.prevent="send" class="grid grid-cols-1 gap-y-6 w-full max-w-sm">
    <x-form.input.text
        :errors="$errors"
        name="email"
        label="Email Address"
        wire:model="email"
        placeholder="your@email.address"
    />

    <div class="col-span-1">
        <x-form.input.button type="submit">Send New Verfication Email</x-form.input.button>
    </div>
</form>

