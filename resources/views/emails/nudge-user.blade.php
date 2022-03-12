@component('mail::message')
# You Have Been Nudged By {{ $nudgedByUser->name }}

{{ $nudgedByUser->name }} has nudged you to record your Wordle scores to [Wordle Group][{{ route('home') }}.

You can also your scores to record them.  Just click "Share" on your Wordle Screen, select your email client, and send your board to [scores@wordlegroup.com](mailto:scores@wordlegroup.com). We'll take care of the rest.

Alternatively, click the below button to visit the record scores page.

@component('mail::button', ['url' => route('account.record-score')])
Record My Scores
@endcomponent

If you are having trouble clicking the above button, you can visit your account home page at the below URL:

[{{ route('account.home') }}]({{ route('account.home') }})

If you would not like to receive reminder emails anymore, [update your account settings]({{ route('account.settings') }}).

Good Luck!
@endcomponent
