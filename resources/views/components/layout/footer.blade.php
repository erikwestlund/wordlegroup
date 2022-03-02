<ul class="flex items-center justify-center">
    <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('group.create') }}">Create Group</a>
    @if($user)
        <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('account.home') }}">Home</a>
        </li>
        <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('logout') }}">Log out</a></li>
    @else
        <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('login') }}">Log In</a>
        <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('home') }}">Home</a>
        </li>
    @endif
</ul>
