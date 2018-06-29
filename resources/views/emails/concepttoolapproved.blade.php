@component('mail::message')
# Je tool {{ $tool->name }} is geaccepteerd

De administrator heeft je tool geaccepteerd
<br>
De tool staat nu publiek op de website, voor iedereen om te zien! :)

@component('mail::button', ['url' => $url])
Bekijk de tool
@endcomponent

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
