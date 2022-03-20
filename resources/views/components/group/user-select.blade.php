<x-form.input.select
    :attributes="$attributes"
    name="groupMemberSelect"
    :label="$label"
    :selected-value="$selectedUserId"
    :options="$options"
    x-on:cleared-activity-feed-filter.window="selectedValue = ''"
/>
