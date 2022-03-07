<div {{ $attributes }}>
    <div class="w-full px-4 sm:px-6 py-3 sm:py-3 bg-green-700 text-white text-center border-b flex justify-center">
        <div class="w-full max-w-6xl flex justify-between">

            <div class="font-bold font-serif text-xl sm:text-2xl">
                <a href="{{ route('home') }}">
                    Wordle Group
                </a>
            </div>
            <div class="flex items-center">
                @if($user)
                    <a class="font-serif font-semibold text-sm sm:text-base mr-4 last:mr-0 border border-transparent bg-white text-green-900 px-2 sm:px-3 hover:bg-gray-100 py-1 sm:py-1 rounded-md inline-flex items-center" href="{{ route('account.home') }}">
                        <x-icon-regular.house class="mr-2 fill-green-800" />
                        {{ $user->name }}
                    </a>
                @else
                    <a class="font-serif text-sm sm:text-base mr-4 last:mr-0 border border-white text-white px-2 sm:px-3 hover:bg-green-800 py-1 sm:py-1 rounded-md inline-flex items-center" href="{{ route('login') }}">
                        Log In
                    </a>
                    <a class="font-serif font-semibold text-sm sm:text-base mr-4 last:mr-0 border border-transparent bg-white text-green-900 px-2 sm:px-3 hover:bg-gray-100 py-1 sm:py-1 rounded-md inline-flex items-center" href="{{ route('group.create') }}">
                        <x-icon-regular.plus class="mr-2 fill-green-700" />
                        Create Group
                    </a>
                @endif

            </div>
        </div>
    </div>
</div>
