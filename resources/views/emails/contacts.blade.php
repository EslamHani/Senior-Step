@component('mail::message')

Dear {{ $name }},

I hope my email find you will

{{ $message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
