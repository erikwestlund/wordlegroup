@component('mail::message')
# Verify Your Email With Wordle Group

Click below to verify that you own the email you used to register with Wordle Group.

@component('mail::button', ['url' => $user->verifyUrl])
Verify My Email
@endcomponent

If you are having trouble clicking the above button, copy the below link into your browser:

{{  $user->verifyUrl }}

If you did not register with Wordle Group, please disregard this email.

Good Luck!
@endcomponent
