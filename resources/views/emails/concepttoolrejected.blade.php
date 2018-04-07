@component('mail::message')
# Je tool is geweigerd

De administrator heeft je tool geweigerd
De tool is nu permanent geweigerd, de reden hiervoor is meestal dat je tool niet relevant was voor {{ config('app.name') }}

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
