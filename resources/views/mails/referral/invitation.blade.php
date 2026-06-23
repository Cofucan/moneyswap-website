@component('mail::message')
<tr>
    <h1 class="welcome-text">Invitation Message from {{$referral->Profile->Person->full_name}}</h1>
    <br>
   <h4 class="pd-2">Dear, {{$referral->email}} </h4> 
    <p class="pd-2">{!! $referral->invitation_message !!}</p>
</tr>


@component('mail::button', ['url' => ''])
Join the Community
@endcomponent

<p class="pd-2">
  Best Regards,<br>
{{ config('app.name') }} Team  
</p>
@endcomponent
