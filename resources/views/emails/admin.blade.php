@component('mail::message')
# New user with email {{ $email }},
Has just signed up on the platform
Kindly keep track of the user,<br>
{{ config('app.name') }}
@endcomponent
