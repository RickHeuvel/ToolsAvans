@component('mail::message')
# Iemand heeft je vraag over {{$tool}} beantwoord.

### {{ $answer->user->nickname }} reageert:
{{ $answer->text }}

@component('mail::button', ['url' => $url])
Bekijk het antwoord
@endcomponent

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
