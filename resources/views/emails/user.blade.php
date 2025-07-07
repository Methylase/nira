@component('mail::message')
# You have just signup on {{ config('app.name') }}

Kindly go ahead to click the button below to
login on the platform

@component('mail::button', ['url' => 'http://127.0.0.1:8000/login' ])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
