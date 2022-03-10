<div {{ $attributes }}>
    <x-form.input.select name="groupMemberSelect" label="Group Member" :selected-value="$selectedUser->id" :options="$options"/>
{{--        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">Group Member</label>--}}
{{--        <select--}}
{{--            {{ $attributes->whereStartsWith('wire:model') }}--}}
{{--            id="{{ $name }}"--}}
{{--            name="{{ $name }}"--}}
{{--            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-600 focus:border-green-500 sm:text-sm rounded-md"--}}
{{--        >--}}
{{--                @foreach($group->memberships as $membership)--}}
{{--                        <option value="{{ $membership->user_id }}" @if($selectedUser->id === $membership->user_id) selected @endif>{{ $membership->user->name }}</option>--}}
{{--                @endforeach--}}
{{--        </select>--}}
</div>
