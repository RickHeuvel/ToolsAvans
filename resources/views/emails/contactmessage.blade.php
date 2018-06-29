@component('mail::message')
# ToolHub vraag - {{ $subject }}

{{$question}}

Van: {{ $name }}

@component('mail::button', ['url' => "mailto:{$email}?subject=Re: {$subject}"])
    Reageer op vraag
@endcomponent

Met vriendelijke groet,<br>
Het {{ config('app.name') }} team
@endcomponent
