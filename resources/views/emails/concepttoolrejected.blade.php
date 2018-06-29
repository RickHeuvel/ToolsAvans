@component('mail::message')
# Je tool {{ $tool->name }} is geweigerd

De administrator heeft je tool {{ $tool->name }} geweigerd
<br>
De tool is nu permanent geweigerd, de reden hiervoor is meestal dat je tool niet relevant was voor {{ config('app.name') }}

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
