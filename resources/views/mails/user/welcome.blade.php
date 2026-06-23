@component('mail::message')

 <tr class="wrapper">
    <h1 class="welcome-text">Welcome to {{ config('app.name') }} Portal</h1>
    <h2 class="pd-2">Dear  {{ $user->Profile->full_name }},</h2>  
    <p class="pd-2">Thank you for registering an account on  <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> Portal. We are delighted to have you on board.</p>     
    <br>
    <h3 class="pd-2">The portal provides you with different tools to save on cross boarder transfers through your verified local peers:</h3>
   {{--  <ul class="pd-2">
        <li>Submit an online application for your child(ren)</li>
        <li>Pay school fees ans</li>
        <li>View client informations </li>
    </ul> --}}
    <br>  
    <p class="pd-2">Feel Free to signin into your profile to learn more about what you can do. Our team is on standby to assist if you experience any difficulty.     
    </p> <br>
    
</tr>
 
 <p class="pd-2">You can also visit our <a href="http://www.moneyswap.xyz/faqs">FAQs</a> for more.</p>             
<br>
{{-- @component('mail::button', ['url' => 'http://www.silvervalleyschools.com/variations'])
Button Text
@endcomponent --}}

<p class="pd-2">
Warm Regards,<br>
{{ config('app.name') }}
</p>

@endcomponent
