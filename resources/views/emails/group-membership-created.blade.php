@component('mail::message')
# Your Have Joined A New Wordle Group

You are now a member of the Wordle Group **{{ $groupMembership->group->name }}**.

To record scores, visit:

**[{{ route('account.record-score') }}]({{ route('account.record-score') }})**


You can also email your scores to [scores@wordlegroup.com](mailto:scores@wordlegroup.com).

[Add wordle group to your contacts.](https://wordlegroup.com/email/WordleGroup.vcf).

Good Luck!<br>
@endcomponent
