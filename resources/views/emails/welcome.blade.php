@component('mail::message')
Hello {{$user->name}}

Please use this button bellow to verify your account

@component('mail::button', ['url' => route('verify', $user->verification_token)])
Verify Account
@endcomponent

Thanks,<br>
Thanh Bang
{{-- {{ config('app.name') }} --}}
@endcomponent
