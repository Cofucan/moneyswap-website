@component('mail::message')


 <tr class="wrapper">
     <br>
    <h1 class="welcome-text">Congratulations! </h1>
    <h2 class="pd-2">Dear  {{ $admission->Client->Profile->full_name }},</h2>
    <p class="pd-2">We are pleased to inform you of <b> {{ $admission->Client->Person->candidate_name }}</b>'s success in our admission exercise,
            and admitted into  <b>{{ $admission->Level->label }} ({{$admission->Stream->stream_name}})</b> for the {{$admission->AcademicTerm->AcademicSession->school_year }} session</p>
    <br>
    <p class="pd-2">
    <a class="btn btn-succcess btn-mail" href="{{ route('admissions.letter',$admission->id) }}"target="_blank"><i class="fa fa-print"></i> Print Admission Letter</a>
    </p> <br>
    <br>

</tr>

 <p class="pd-2">We look forward to welcoming you to <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> on  <u>{{ $admission->feedback_deadline }}</u></p>
<br>
{{-- @component('mail::button', ['url' => 'http://www.silvervalleyschools.com/variations'])
Button Text
@endcomponent --}}

<p class="pd-2">
<b>Mr. Charles Olawumi,</b><br>
Principal
</p>

@endcomponent
