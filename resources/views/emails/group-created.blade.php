@component('mail::message')
# Your Wordle Group Has Been Created!

You are now the group administrator of **{{ $group->name }}**.

To manage your group, visit:

**[{{ route('group.home', $group) }}]({{ route('group.home', $group) }})**

*Reminder:* You can always email your scores to [scores@wordlegroup.com](mailto:scores@wordlegroup.com).

Good Luck!<br>
@endcomponent
