@component('mail::message')
# Ongekeurde concept {{ str_plural('tool', count($tools)) }}

Er staan {{ count($tools) }} concept {{ str_plural('tool', count($tools)) }} op ToolHub die gekeurd kunnen worden!

@component('mail::button', ['url' => $url])
Bekijk de ongekeurde concept{{ str_plural('tool', count($tools)) }}
@endcomponent

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
