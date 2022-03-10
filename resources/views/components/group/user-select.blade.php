<x-form.input.select
    :attributes="$attributes"
    name="groupMemberSelect"
    label="Group Member"
    :selected-value="$selectedUser->id"
    :options="$options"
/>
