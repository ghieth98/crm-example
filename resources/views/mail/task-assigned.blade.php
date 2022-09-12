@component('mail::message')
# Task Assignment

Task _{{ $title }}_ have been assigned to you.

@component('mail::button', ['url' => $url])
View Task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
