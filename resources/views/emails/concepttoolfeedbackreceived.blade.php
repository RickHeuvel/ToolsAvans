@component('mail::message')
# Feedback ontvangen

De administrator heeft feedback achter gelaten op je opgestuurde Tool
Verbeter de feedback om de tool nogmaals op te sturen voor keuring

@component('mail::button', ['url' => $url])
Bekijk de feedback
@endcomponent

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
