@component('mail::message')

# Reset Password Link

## Hi {{ $user->username }},

You are receiving this email because we received a password reset request for your account.

Here is the reset password link, it will expire in {{ config('auth.passwords.users.expire') }} minutes.

[{{ route('password.reset', ['token' => $token]) }}]({{ route('password.reset', ['token' => $token]) }})

If you did not request a password reset, no further action is required, the password will not be changed.


<br>
** Thanks,<br>
{{ config('app.name') }} **

@endcomponent