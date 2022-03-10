<x-layout.page-container :heading="$heading" title="Wordle Group Settings">


    <x-account.home-layout :page="'group.' . $group->id . '.settings'">

        <form type="PATCH" class="mb-0 flex justify-center mx-auto" wire:submit.prevent="update">
            <div class="grid grid-cols-1 gap-y-6 w-80">
                <x-form.input.text
                    :errors="$errors"
                    name="group.name"
                    label="Name"
                    wire:model="group.name"
                    placeholder="Name"
                />

                <div class="col-span-1">
                    <x-form.input.button type="submit" loading-action="update" class="w-20">Save</x-form.input.button>
                </div>
            </div>
        </form>
    </x-account.home-layout>


</x-layout.page-container>
