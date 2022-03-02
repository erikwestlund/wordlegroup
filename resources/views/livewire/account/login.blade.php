<x-layout.page-container
    :error-message="$errors->has('attempt') ? $errors->get('attempt') : null"
    heading="Log In To Wordle Group"
    title="Log In To Wordle Group"
>
    <form wire:submit.prevent="send" class="grid grid-cols-1 gap-y-6 w-full max-w-sm w-full mx-auto">
        <x-form.input.text
            :errors="$errors"
            name="email"
            label="Email Address"
            wire:model="email"
            placeholder="your@email.address"
        />

        <div class="col-span-1">
            <x-form.input.button type="submit">Send Log In Link</x-form.input.button>
        </div>

        <div class="col-span-1 pt-6 text-sm">
            <a class="link" href="{{ route('register') }}">Don't have an account? Register one here.</a>
        </div>
    </form>
</x-layout.page-container>
