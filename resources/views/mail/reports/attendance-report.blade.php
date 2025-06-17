@component('mail::message')
# Attendance Report

Hello,

Attached is the attendance report for **{{ $period }}**.

@component('mail::button', ['url' => $downloadUrl])
Download Report    
@endcomponent

Thanks, <br>
{{ config('app.name') }}
@endcomponent