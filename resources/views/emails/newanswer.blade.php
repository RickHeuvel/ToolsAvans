@component('mail::message')
# Iemand heeft je vraag over {{$tool}} beantwoord.

@component('mail::button', ['url' => $url])
Bekijk het antwoord
@endcomponent

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
