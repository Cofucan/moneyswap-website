@component('mail::message')
<tr>
        <img src="{{ asset( 'images/newsletter.jpg' )}}" alt="Thanks, You're Signed in" class="w-100">
        <h2 class="newsletter-text">You've been added to our mailing list and will now be among the first <br> to get latest updates on upcoming events and offers.</h2>
</tr>

    
    {{-- <p class="pd-2">    
    <a href="http://www.silvervalleyschools.com/registrations" class="btn btn-succcess btn-mail">Print Application form</a></p> <br> --}}
    

<br>
{{-- @component('mail::button', ['url' => 'http://www.silvervalleyschools.com/variations'])
Button Text
@endcomponent --}}

<p class="pd-2">   
Warm Regards,<br>
{{ config('app.name') }}
</p>

@endcomponent
