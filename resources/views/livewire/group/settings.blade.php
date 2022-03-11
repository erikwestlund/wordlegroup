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

                <x-group.user-select
                    name="userId"
                    label="Group Administrator"
                    :errors="$errors"
                    :group="$group"
                    :selected-user-id="$group->admin_user_id"
                    wire:model="group.admin_user_id"
                />

                <x-form.input.checkbox
                    name="publicGroup"
                    wire:model="group.public"
                    label="Make this group public."
                    tip="This will allow non-group members to see the group page. Users who wish to stay private can still hide their names."
                />

                <div>
                    @if($initialAdminUserId !== $group->admin_user_id)
                        <x-form.input.checkbox
                            :errors="$errors"
                            name="confirmTransfer"
                            wire:model="confirmTransfer"
                            label="Confirm Transfer"
                            tip="After transferring administrators, you will no longer be able to administrate this group."
                        />
                    @endif
                </div>

                <div class="col-span-1">
                    <x-form.input.button
                        type="submit"
                        loading-action="update"
                        class="w-20"
                    >Save</x-form.input.button>
                </div>
            </div>
        </form>
    </x-account.home-layout>


</x-layout.page-container>
