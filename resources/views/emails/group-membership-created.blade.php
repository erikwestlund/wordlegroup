@component('mail::message')
# Your Have Joined A New Wordle Group

You are now a member of the Wordle Group **{{ $groupMembership->group->name }}**.

To record scores, visit:

**[{{ $groupMembership->user->recordScoreUrl }}]({{ $groupMembership->user->recordScoreUrl }})**

Bookmark this URL and do not share it with any who you do not want to be allowed to record scores for you.

Good Luck!<br>
@endcomponent
