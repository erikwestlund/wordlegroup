<!-- This example requires Tailwind CSS v2.0+ -->
<nav class="bg-green-700">
    <div class="px-4 mx-auto max-w-2xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <a
                    href="{{ Auth::check() ? route('account.home') : route('home') }}"
                    class="flex flex-shrink-0 items-center"
                >
                    <span
                        class="flex justify-center items-center h-6 w-6 sm:w-10 sm:h-10 font-serif text-lg sm:text-2xl font-extrabold text-green-800 bg-green-50 rounded-md"
                    >W</span>
                    <span class="px-2 sm:px-3 text-white font-semibold font-serif text-lg sm:text-xl">
                            Wordle Group
                        </span>
                </a>
                {{--                <div class="hidden md:ml-6 md:flex md:items-center md:space-x-4">--}}
                {{--                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->--}}
                {{--                    <a href="#" class="px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-md" aria-current="page">Dashboard</a>--}}

                {{--                    <a href="#" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Team</a>--}}

                {{--                    <a href="#" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Projects</a>--}}

                {{--                    <a href="#" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Calendar</a>--}}
                {{--                </div>--}}
            </div>
            <div class="flex items-center">
                <div class="flex items-center flex-shrink-0">
                    @if(Auth::check())
{{--                        <a--}}
{{--                            role="button"--}}
{{--                            class="inline-flex relative items-center px-4 py-2 text-sm font-medium text-white bg-transparent  rounded-md border-2 border-white shadow-sm hover:bg-yellow-500 hover:border-transparent hover:text-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-700 focus:ring-yellow-500"--}}
{{--                            href="{{ route('group.create') }}"--}}
{{--                        >--}}
{{--                            <!-- Heroicon name: solid/plus-sm -->--}}
{{--                            <x-icon-solid.plus class="w-4 h-4 mr-2 -ml-1"/>--}}
{{--                            <span>New Group</span>--}}
{{--                        </a>--}}
                    @else
                        <a
                            class="flex relative items-center px-5 py-1.5 sm:py-2 text-sm font-medium text-white bg-transparent rounded-md border-2hover:bg-yellow-500 hover:border-transparent hover:text-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-700 focus:ring-yellow-500"
                            href="{{ route('login') }}"
                        >
                            Log In
                        </a>
                        <a
                            class="flex relative items-center px-4 py-1.5 sm:py-2 text-sm font-medium text-white bg-transparent  rounded-md border-2 border-white hover:bg-yellow-500 hover:border-transparent hover:text-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-700 focus:ring-yellow-500"
                            href="{{ route('group.create') }}"
                        >
                            <!-- Heroicon name: solid/plus-sm -->
                            <x-icon-solid.plus class="w-4 h-4 mr-2 -ml-1"/>
                            <span class="hidden sm:inline">New Group</span>
                            <span class="sm:hidden inline">Group</span>
                        </a>
                    @endif
                </div>
                @if(Auth::check())
                <div class="ml-4 md:flex-shrink-0 flex items-center">

                    <div class="relative ml-3">
                        <div>
                            <x-layout.dropdown
                                name="user-dropdown"
                                width="w-56"
                                dropdown-custom="right-0 sm:left-1/2 sm:transform sm:-translate-x-1/2"
                                button-class="w-8 h-8 rounded-full text-green-800 bg-green-50 hover:bg-yellow-500 text-green-700 flex items-center justify-center font-semibold text-xl"
                            >
                                <x-slot name="buttonSlot">
                                    <span class="sr-only">Open user menu</span>
                                    <x-icon-solid.circle-user class="h-7 w-7 fill-current"/>
                                </x-slot>

                                <ul class="py-1">
                                    <li class="border-gray-100 border-b last:border-gray-100 border-b-0">
                                        <a class="text-sm px-3 py-2 block text-gray-600 hover:bg-gray-50" href="{{ route('account.home') }}">Account Summary</a>
                                    </li>
                                    <li class="border-gray-100 border-b last:border-gray-100 border-b-0">
                                        <a class="text-sm px-3 py-2 block text-gray-600 hover:bg-gray-50" href="{{ route('account.groups') }}">My Groups</a>
                                    </li>
                                    <li class="border-gray-100 border-b last:border-gray-100 border-b-0">
                                        <a class="text-sm px-3 py-2 block text-gray-600 hover:bg-gray-50" href="{{ route('account.record-score') }}">Record Score</a>
                                    </li>
                                    <li class="border-gray-100 border-b last:border-gray-100 border-b-0">
                                        <a class="text-sm px-3 py-2 block text-gray-600 hover:bg-gray-50" href="{{ route('account.settings') }}">Settings</a>
                                    </li>
                                    <li class="">
                                        <a class="text-sm px-3 py-2 block text-gray-600 hover:bg-gray-50" href="{{ route('logout') }}">Logout</a>
                                    </li>
                                </ul>
                            </x-layout.dropdown>
                        </div>

                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>


</nav>

{{--<div {{ $attributes }}>--}}
{{--    <div class="flex justify-center px-4 py-3 w-full text-center text-white bg-green-700 border-b sm:px-6 sm:py-3">--}}
{{--        <div class="flex justify-between w-full max-w-6xl">--}}

{{--            <div class="font-serif text-xl font-bold sm:text-2xl">--}}
{{--                <a href="{{ route('home') }}">--}}
{{--                    Wordle Group--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="flex items-center">--}}
{{--                @if($user)--}}
{{--                    <a class="inline-flex items-center px-2 py-1 mr-4 font-serif text-sm font-semibold text-green-900 bg-white rounded-md border border-transparent sm:text-base last:mr-0 sm:px-3 hover:bg-gray-100 sm:py-1" href="{{ route('account.home') }}">--}}
{{--                        <x-icon-regular.house class="mr-2 fill-green-800" />--}}
{{--                        {{ $user->name }}--}}
{{--                    </a>--}}
{{--                @else--}}
{{--                    <a class="inline-flex items-center px-2 py-1 mr-4 font-serif text-sm text-white rounded-md border border-white sm:text-base last:mr-0 sm:px-3 hover:bg-green-800 sm:py-1" href="{{ route('login') }}">--}}
{{--                        Log In--}}
{{--                    </a>--}}
{{--                    <a class="inline-flex items-center px-2 py-1 mr-4 font-serif text-sm font-semibold text-green-900 bg-white rounded-md border border-transparent sm:text-base last:mr-0 sm:px-3 hover:bg-gray-100 sm:py-1" href="{{ route('group.create') }}">--}}
{{--                        <x-icon-regular.plus class="mr-2 fill-green-700" />--}}
{{--                        Group--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
