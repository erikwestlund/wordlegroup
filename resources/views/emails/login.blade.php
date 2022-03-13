@component('mail::message')
# Log In To Wordle Group

To log into Wordle Group, enter the below code:

`{{ $user->login_code }}`

This code expires in 15 minutes.

You can also just click the below link to log in automatically.

@component('mail::button', ['url' => $user->loginUrl])
Log In
@endcomponent

If you are having trouble clicking the above button, copy the below link into your browser:

{{  $user->loginUrl }}

You can always email your scores to [scores@wordlegroup.com](mailto:scores@wordlegroup.com).

Good Luck!
@endcomponent
