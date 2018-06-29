@component('mail::message')
# Feedback ontvangen op je tool {{ $tool->name }}

## De administrator heeft feedback achter gelaten op je opgestuurde Tool
### Feedback:
{{ $tool->feedback->feedback }}
<br>
Verbeter de feedback om de tool nogmaals op te sturen voor keuring

@component('mail::button', ['url' => $url])
Verbeter de feedback
@endcomponent

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
