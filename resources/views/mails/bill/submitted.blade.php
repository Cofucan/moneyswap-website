@component('mail::message')
<tr>
    <h1 class="welcome-text"> {{$bill->AcademicTerm->academic_term}} Bill Generated</h1>
        <h2 class="pd-2">Dear {{ $bill->Client->Profile->Person->full_name }},</h2> <br>
        <p class="pd-2">A new bill has been generated for {{ $bill->Client->Person->candidate_name }}, kindly login to your dashboard to review and accept the bill.</h3>
        <br><br>
        <p class="pd-2">
                <a class="btn btn-succcess btn-mail" target="_blank" href="{{ route('bills.show',$bill->id) }}"> View Bill Detail </a>
                {{-- <a href="http://www.silvervalleyschools.com/registrations" class="btn btn-succcess btn-mail">Review Now</a> --}}
            </p>
            <br>
</tr>

{{--
 @component('mail::button', ['url' => ''])
Verify
@endcomponent --}}

<p class="pd-2">
    Thanks, <br> {{ config('app.name') }}
</p>

@endcomponent

