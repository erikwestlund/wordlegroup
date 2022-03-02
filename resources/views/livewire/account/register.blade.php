<x-layout.page-container heading="Register A Wordle Group Account" title="Register A Wordle Group Account">
    <form wire:submit.prevent="store">
        <div class="mt-4 py-8 grid grid-cols-1 gap-y-8">

            @unless(Auth::check())
                <x-form.input.text
                    wire:model="name" name="name" :errors="$errors" label="Your Name" placeholder="Your Name"
                />
                <x-form.input.text
                    wire:model="email"
                    name="email"
                    :errors="$errors"
                    type="email"
                    label="Email Address"
                    placeholder="my@email.com"
                />
            @endunless
        </div>
        <x-form.input.button>Register</x-form.input.button>
    </form>
</x-layout.page-container>
