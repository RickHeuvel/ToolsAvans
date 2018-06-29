@component('mail::message')
# Je tool {{ $tool->name }} is verouderd gemeld door {{ $tool->outdatedReport->user->nickname }}

### Feedback:
{{ $tool->outdatedReport->feedback }}
<br>
Ga nu naar je tool om hem aan te passen, de feedback te verbeteren en de verouderd status weg te halen.

@component('mail::button', ['url' => $url])
{{ $tool->name }} aanpassen
@endcomponent

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
