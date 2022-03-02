<div>
    <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select a tab</label>
        <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
        <select
            id="tabs"
            name="tabs"
            class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
            x-data="{selected: '{{ $activePage }}', urlMap: {{ json_encode($pages, JSON_HEX_APOS) }} }"
            x-model="selected"
            x-on:change="window.location.href = urlMap[selected]['route']"
        >
            @foreach($pages as $pageName => $page)
                <option value="{{ $pageName }}" {{ $activePage === $pageName ? ' selected' : '' }}>{{ $page['title'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="hidden sm:block">
        <nav class="flex space-x-4" aria-label="Tabs">
            @foreach($pages as $pageName => $page)
                <a
                    href="{{ $page['route'] }}"
                    class="@if($activePage === $pageName) bg-gray-100 text-gray-700 @else text-gray-500 hover:text-gray-700 @endif px-3 py-2 font-medium text-sm rounded-md"
                    @if($activePage === $pageName) aria-current="page" @endif
                > {{ $page['title'] }} </a>
            @endforeach
        </nav>
    </div>
</div>
