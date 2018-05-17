@component('mail::message')
# Je tool {{ $toolName }} is verouderd

Een student heeft je tool als verouderd gemeld.
<br>
Ga nu naar je tool om hem aan te passen, de feedback te verbeteren en de verouderd status weg te halen.

@component('mail::button', ['url' => $url])
{{ $toolName }} aanpassen
@endcomponent

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
