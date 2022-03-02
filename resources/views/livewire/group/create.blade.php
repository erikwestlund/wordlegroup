<x-layout.page-container heading="Create A New Wordle Group" title="Group a Wordle Group">
    <form wire:submit.prevent="store">
        <div class="mt-4 py-8 grid grid-cols-1 gap-y-8">
            <x-form.input.text
                wire:model="groupName" name="groupName" :errors="$errors" label="Group Name" placeholder="My Group"
            />
            @unless(Auth::check())
                <x-form.input.text
                    wire:model="email" name="email" :errors="$errors" type="email" label="Email Address"
                    placeholder="my@email.com"
                />
                <x-form.input.text
                    wire:model="userName" name="groupName" :errors="$errors" label="Your Name" placeholder="Your Name"
                />
            @endunless
        </div>
        <x-form.input.button>Create</x-form.input.button>
    </form>
</x-layout.page-container>

