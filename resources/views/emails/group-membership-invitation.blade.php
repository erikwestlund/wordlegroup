@component('mail::message')
Hi {{ $invitation->name }},

**{{ $invitation->invitingUser->name }}** has invited you to join their Wordle Group *{{ $invitation->group->name }}*.

Wordle Group lets you keep track of your scores and compete with friends.

@component('mail::button', ['url' => $invitation->invitationUrl])
    Click Here To Join
@endcomponent

If you are having trouble clicking the above button, copy the below link into your browser:

{{ $invitation->invitationUrl }}

If you do not want to join this Wordle Group, just ignore this email and we'll delete the invitation within 24 hours.

Good Luck!
@endcomponent
