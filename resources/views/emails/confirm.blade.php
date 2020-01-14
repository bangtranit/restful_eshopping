@component('mail::message')
Hello {{$user->name}}

You changed your email, so we need to verify this new address. Please use this button bellow:

@component('mail::button', ['url' => route('verify', $user->verification_token)])
Verify Account
@endcomponent

Thanks,<br>
Thanh Bang
{{-- {{ config('app.name') }} --}}
@endcomponent
