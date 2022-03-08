<div>
    <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select a tab</label>
        <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
        <select
            id="tabs"
            name="tabs"
            class="block w-full focus:ring-green-500 focus:border-green-500 border-gray-300 rounded-md"
            x-data="{selected: '{{ $activePage }}', routeMap: {{ json_encode($routeMap, JSON_HEX_APOS) }} }"
            x-init="console.log(routeMap)"
            x-on:change="window.location.href = routeMap[$event.target.value]"
        >
            @foreach($pages as $pageName => $page)
                @if(isset($page['placeholder']) && $page['placeholder'])
                    <option
                        value="{{ $pageName }}" {{ $pageName === 'placeholder' ? ' disabled selected' : '' }}
                    >{{ $page['title'] }}</option>
                @elseif($pageName === 'userGroups')
                    <optgroup label="{{ $page['title'] }}">
                        @foreach($user->memberships as $membership)
                            <option
                                value="group.{{ $membership->group_id }}" {{ $activePage === "group.{$membership->group_id}" ? ' selected' : '' }}>{{ $membership->group->name }}</option>
                        @endforeach
                    </optgroup>
                @else
                    <option
                        value="{{ $pageName }}" {{ $activePage === $pageName ? ' selected' : '' }}>{{ $page['title'] }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="hidden sm:block">
        <nav class="flex space-x-4" aria-label="Tabs">
            @foreach($pages as $pageName => $page)
                @if($pageName === 'userGroups')
                    <x-layout.dropdown label="My Groups" name="userGroups">
                        <ul>
                        @foreach($user->memberships as $membership)
                            <li class="px-4 py-2 border-b border-gray-100 last:border-0 text-sm text-gray-500 hover:bg-gray-50">
                                <a class="block" href="{{ route('group.home', $membership->group) }}">{{ $membership->group->name }}</a>
                            </li>
                        @endforeach
                        </ul>
                    </x-layout.dropdown>
                @elseif(in_array($pageName, ['groups', 'placeholder']))

                @else

                    <a
                        href="{{ $page['route'] }}"
                        class="@if($activePage === $pageName) bg-gray-100 text-gray-700 @else text-gray-500 hover:text-gray-700 @endif px-3 py-2 font-medium text-sm rounded-md"
                        @if($activePage === $pageName) aria-current="page" @endif
                    > {{ $page['title'] }} </a>
                @endif
            @endforeach
        </nav>
    </div>
</div>
