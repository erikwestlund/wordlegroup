@component('mail::message')
# Your Wordle Group Has Been Created!

You are now the group administrator of **{{ $group->name }}**.

To manage your group, visit:

**[{{ $group->adminUrl }}]({{ $group->adminUrl }})**

Bookmark this URL and do not share it with any who you do not want to be allowed to administer the group.

Good Luck!<br>
@endcomponent
