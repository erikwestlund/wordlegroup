<div>
    <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select a tab</label>
        <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
        <select
            id="tabs"
            name="tabs"
            class="block w-full focus:ring-green-500 focus:border-green-500 border-gray-300 rounded-md"
            x-data="{selected: '{{ $activePage }}', routeMap: {{ json_encode($routeMap, JSON_HEX_APOS) }} }"
            x-on:change="window.location.href = routeMap[$event.target.value]"
        >
            @foreach($pages as $pageName => $page)
                @if(isset($page['placeholder']) && $page['placeholder'])
                    <option
                        value="{{ $pageName }}" {{ $pageName === 'placeholder' ? ' disabled selected' : '' }}
                    >{{ $page['title'] }}</option>
                @elseif($pageName === 'userGroups')

                @else
                    <option
                        value="{{ $pageName }}" {{ $activePage === $pageName ? ' selected' : '' }}>{{ $page['title'] }}</option>
                @endif
            @endforeach
            <optgroup label="Group Pages">
                @foreach($user->memberships as $membership)
                    <option
                        value="group.{{ $membership->group_id }}" {{ $activePage === "group.{$membership->group_id}" ? ' selected' : '' }}>{{ $membership->group->name }}</option>
                @endforeach
            </optgroup>
        </select>
    </div>
    <div class="hidden sm:block">
        <nav class="flex space-x-4" aria-label="Tabs">
            @foreach($pages as $pageName => $page)
                @if($pageName === 'userGroups')
                    <x-layout.dropdown
                        label="My Groups"
                        name="userGroups"
                        width="w-72"
                        :button-class="'px-3 py-2 font-medium text-sm rounded-md ' . ($activePage === 'groups' ? 'bg-gray-100 text-gray-700' : 'text-gray-500 hover:text-gray-700')"
                    >
                        <ul>
                            @foreach($user->memberships as $membership)
                                <li
                                    class="block px-4 py-2 border-b border-gray-200 last:border-0 text-gray-500 hover:bg-gray-50"
                                >
                                    <a href="{{ route('group.home', $membership->group) }}">
                                        <div class="font-bold text-green-700"
                                        >{{ $membership->group->name }}</div>
                                        <div class="mt-1">
                                            <ul class=" text-sm">
                                                @if($membership->group->leaderboard && isset($membership->group->leaderboard->first()['name']))
                                                    <li class="mt-0.5 first:mt-0">
                                                        <span class="font-medium">Leader:</span>
                                                        {{ $membership->group->leaderboard->first()['name']  }}, {{ number_format($membership->group->leaderboard->first()['stats']['mean'], 2) }}
                                                    </li>
                                                    <li class="mt-0.5 first:mt-0">
                                                        <span class="font-medium">Avg. Score:</span>
                                                        {{ number_format($membership->group->score_mean, 2) }}
                                                    </li>
                                                    <li class="mt-0.5 first:mt-0">
                                                        <span class="font-medium">My Place:</span>
                                                        {{ $membership->group->leaderboard->firstWhere('user_id', $user->id)['place'] }}/{{ $membership->group->leaderboard->pluck('place')->max() }}
                                                    </li>
                                                @endif
                                              </ul>
                                        </div>
                                    </a>
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
