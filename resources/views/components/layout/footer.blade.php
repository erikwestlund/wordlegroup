
<ul class="flex items-center justify-center">
    <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('group.create') }}">Create Group</a>
    @if(! Auth::check())
        <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('login') }}">Log In</a>
        <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('register') }}">Register</a>
        </li>
    @else
        <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('logout') }}">Log out</a></li>
    @endif
</ul>

<ul class="flex items-center justify-center mt-6">
    <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('about') }}">About</a>
    <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('rules-and-faq') }}">Rules/FAQ</a>
    <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('contact') }}">Contact</a>
    <li class="text-sm mr-6 last:mr-0 link"><a href="{{ route('privacy-policy') }}">Privacy Policy</a>
</ul>
