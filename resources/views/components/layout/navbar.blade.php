<div {{ $attributes }}>
    <div class="w-full py-4 bg-green-700 text-white text-center border-b flex justify-center">
        <div class="w-full max-w-6xl flex justify-between">

            <div class="font-bold font-serif text-3xl">
                Wordle Group
            </div>
            <div class="flex items-center">
                @if($user)
                    <a class="" href="">Record Score</a>
                    <a class="" href="">My Groups</a>
                @else
                    <a class="mr-4 last:mr-0 border border-white text-white px-3 hover:bg-green-800 py-2 rounded-md inline-flex items-center" href="{{ route('account.login') }}">
                        Sign In
                    </a>
                    <a class="mr-4 last:mr-0 border border-transparent bg-white text-green-900 px-3 hover:bg-gray-100 py-2 rounded-md inline-flex items-center" href="{{ route('group.create') }}">
                        <x-icon-regular.plus class="mr-2 fill-green-700" />
                        Create Group
                    </a>
                @endif

            </div>
        </div>
    </div>
</div>
