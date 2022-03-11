<!-- This example requires Tailwind CSS v2.0+ -->
<nav class="bg-green-700">
    <div class="px-4 mx-auto max-w-2xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 sm:h-16">
            <div class="flex">
                <a
                    href="{{ Auth::check() ? route('account.home') : route('home') }}"
                    class="flex flex-shrink-0 items-center text-white"
                    x-data="{hover: false}"
                    @mouseover="hover = true"
                    @mouseout="hover = false"
                >
                    <span
                        class="flex justify-center items-center h-6 w-6 sm:w-10 sm:h-10 font-serif text-lg sm:text-2xl font-extrabold rounded-md"
                        :class="hover ? 'bg-wordle-yellow text-white' : 'bg-green-50 text-green-800 '"
                        x-transition:fade
                    >W</span>
                    <span
                        class="px-2 sm:px-3 font-semibold font-serif text-lg sm:text-xl"
                        :class="{ 'green-nav-link-underline' : hover }"
                    >
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
                    @else
                        <a
                            class="flex relative items-center px-4 py-1.5 sm:py-2 text-sm font-medium text-white bg-transparent rounded-md hover:text-wordle-yellow hover:border-transparent hover:text-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-700 focus:ring-wordle-yellow"
                            href="{{ route('login') }}"
                        >
                            Log In
                        </a>
                        <a
                            class="ml-2 flex relative items-center px-4 py-1.5 sm:py-2 text-sm font-medium text-white bg-transparent  rounded-md border-2 border-white hover:bg-wordle-yellow hover:border-transparent hover:text-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-700 focus:ring-wordle-yellow"
                            href="{{ route('group.create') }}"
                        >
                            <x-icon-solid.plus class="w-4 h-4 mr-2 -ml-1"/>
                            <span class="hidden sm:inline">New Group</span>
                            <span class="sm:hidden inline">Group</span>
                        </a>
                    @endif
                </div>
                @if(Auth::check())
                <div class="ml-4 md:flex-shrink-0 flex items-center">

                    <div class="relative ml-3">
                        <div class="flex items-center">
                            <a
                                class="mr-2 flex relative items-center px-4 py-1.5 sm:py-2 text-sm font-medium green-nav-link bg-transparent rounded-md hover:border-transparent focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-700 focus:ring-wordle-yellow"
                                href="{{ route('account.home') }}"
                            >
                                My Stats
                            </a>
                            <x-layout.dropdown
                                name="user-dropdown"
                                width="w-56"
                                dropdown-custom="right-0 sm:left-1/2 sm:transform sm:-translate-x-1/2"
                                button-class="w-7 h-7 rounded-full text-green-800 bg-green-50 hover:bg-wordle-yellow text-green-700 flex items-center justify-center font-semibold text-xl"
                            >
                                <x-slot name="buttonSlot">
                                    <span class="sr-only">Open user menu</span>
                                    <x-icon-solid.circle-user class="h-6 w-6 fill-current"/>
                                </x-slot>

                                <ul class="py-1">
                                    <li class="border-gray-100 border-b last:border-b-0">
                                        <a class="text-sm px-3 py-2 block text-gray-600 hover:bg-gray-50" href="{{ route('account.record-score') }}">Record Score</a>
                                    </li>
                                    <li>
                                        <a class="text-sm px-3 py-2 block text-gray-600 hover:bg-gray-50" href="{{ route('account.home') }}">My Stats</a>
                                    </li>
                                    <li>
                                        <a class="text-sm px-3 py-2 block text-gray-600 hover:bg-gray-50" href="{{ route('account.groups') }}">My Groups</a>
                                    </li>
                                    <li class="border-gray-100 border-b last:border-b-0">
                                        <a class="text-sm px-3 py-2 block text-gray-600 hover:bg-gray-50" href="{{ route('account.settings') }}">My Settings</a>
                                    </li>
                                    <li class="border-gray-100 border-b last:border-b-0">
                                        <a class="text-sm px-3 py-2 block text-gray-600 hover:bg-gray-50" href="https://www.nytimes.com/games/wordle/index.html">Play Wordle</a>
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
