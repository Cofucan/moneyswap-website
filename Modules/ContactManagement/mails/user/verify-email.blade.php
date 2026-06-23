@component('mail::message')
<tr class="verify">
    <h1 class="welcome-text">Verify Your Email</h1>
<h3> Dear {{ $user->Profile->full_name }},</h3>
<h4>Thank you for creating an account on {{ config('app.name')}}. 
    If the Account was created for you by the admin, your <strong>last name</strong> is your default password
    You must Click the link below to validate your account before you can use the portal.</h4>
</tr>

@component('mail::button', ['url' => ''])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
