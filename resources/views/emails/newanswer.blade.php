@component('mail::message')
# {{ $answer->user->nickname }} heeft je vraag over {{$tool}} beantwoord.

### Antwoord:
{{ $answer->text }}

@component('mail::button', ['url' => $url])
Bekijk het antwoord
@endcomponent

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
