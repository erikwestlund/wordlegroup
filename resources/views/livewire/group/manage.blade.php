<div>
    <x-layout.centered-header>{{ $group->name }}</x-layout.centered-header>

    <div class="mx-auto w-full max-w-lg mt-8">

        <div class="grid grid-cols-1 gap-y-8">
            <div class="col-span-1">
                <h2 class="text-indigo-700 text-lg font-semibold">Add Member</h2>

                <livewire:group.add-member :group="$group" />
            </div>

            <div class="col-span-1">
                <h2 class="text-indigo-700 text-lg font-semibold">Manage Members</h2>
            </div>

            <div class="col-span-1">
                <h2 class="text-indigo-700 text-lg font-semibold">Rename Group</h2>

                <livewire:group.rename :group="$group" />
            </div>

        </div>
    </div>
</div>
