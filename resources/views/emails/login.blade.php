@component('mail::message')
# Log In To Wordle Group

Click the below link to log in to Wordle Group.

@component('mail::button', ['url' => $user->loginUrl])
Log In
@endcomponent

If you are having trouble clicking the above button, copy the below link into your browser:

{{  $user->loginUrl }}

You can always email your scores to [scores@wordlegroup.com](mailto:scores@wordlegroup.com).  [Add wordle group to your contacts.](https://wordlegroup.com/email/WordleGroup.vcf).

Good Luck!
@endcomponent
