@component('mail::message')


 <tr class="wrapper">
     <br>
    {{-- <h1 class="welcome-text">Welcome to {{ config('app.name') }} Portal </h1> --}}
    <h2 class="pd-2">Dear  {{ $admission->Client->Profile->full_name }},</h2>
    <p class="pd-2">It is our pleasure to inform you that your child <b>{{ $admission->Client->Person->name }}</b> was successful at our 2019/ 2020 entrance examination and has been admitted to our college. Kindly login to the <a href="http://www.silvervalleyschools.com/admin">School Portal</a>  to accept the offer</p>
    <br>
    <p class="pd-2">
    <a class="btn btn-succcess btn-mail" href="{{ route('admissions.offer',$admission->id) }}"target="_blank"><i class="fa fa-print"></i> Print Offer Letter</a>
    </p> <br>
    <br>

</tr>

 <p class="pd-2">I look forward to welcoming you to <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> on  <u>{{ $admission->feedback_deadline }}</u></p>
<br>
{{-- @component('mail::button', ['url' => 'http://www.silvervalleyschools.com/variations'])
Button Text
@endcomponent --}}

<p class="pd-2">
<b>Mr. Charles Olawumi,</b><br>
Principal
</p>

@endcomponent
