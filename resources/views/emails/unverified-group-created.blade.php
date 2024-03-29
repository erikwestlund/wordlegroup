@component('mail::message')
# Verify Your Wordle Group

Before we create your new Wordle Group named **{{ $group->name }}**, we need to verify that you own the email you used to create the group.

@component('mail::button', ['url' => $group->verifyUrl])
Verify My Email
@endcomponent

If you are having trouble clicking the above button, copy the below link into your browser:

{{  $group->verifyUrl }}

Good Luck!
@endcomponent
