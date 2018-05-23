@component('mail::message')
# Er is een vraag gesteld over {{$tool}}

{{$title}}

{{$text}}

@component('mail::button', ['url' => $url])
Bekijk de vraag
@endcomponent


Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
