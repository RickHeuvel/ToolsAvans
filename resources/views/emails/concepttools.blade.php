@component('mail::message')
# Concept {{ str_plural('tool', count($tools)) }}

Er staan {{ count($tools) }} {{ str_plural('tool', count($tools)) }} op ToolHub die gekeurd kunnen worden!

@component('mail::button', ['url' => $url])
Bekijk {{ str_plural('tool', count($tools)) }}
@endcomponent

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent