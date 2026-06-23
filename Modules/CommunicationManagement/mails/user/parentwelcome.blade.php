@component('mail::message')


 <tr class="wrapper">
    <h1 class="welcome-text">Welcome to {{ config('app.name') }} Portal</h1>
    <h2 class="pd-2">Dear  {{ $user->Profile->full_name }},</h2>  
    <p class="pd-2">Thank you for registering an account on  <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> Portal. We are delighted to have you on board.</p>     
    <br>
    <h3 class="pd-2">On the parent platform you'll be able to:</h3>
    <ul class="pd-2">
        <li>Submit an online application for your child(ren)</li>
        <li>Pay school fees ans</li>
        <li>View client informations </li>
    </ul>
    <br>  
    <p class="pd-2">We are looking forward to a productive partnership with you to ensure our children can achieve their highest potential. 
        We know a strong partnership with you will make a significant difference in your child’s education.     
    </p> <br>
    
</tr>
 
 <p class="pd-2">If you would like to know more about our services, please also refer to our <a href="http://www.silvervalleyschools.com/faqs">FAQs</a> from our customers.</p>             
<br>
{{-- @component('mail::button', ['url' => 'http://www.silvervalleyschools.com/variations'])
Button Text
@endcomponent --}}

<p class="pd-2">
Warm Regards,<br>
{{ config('app.name') }}
</p>

@endcomponent
