@component('mail::message')
<tr>

</tr>
<div>
    <h1 class="welcome-text">Registration Confirmations</h1>
    <h2 class="pd-2">Dear  {{ $registration->Profile->full_name }},</h2>
    <p class="pd-2">This is to confirm that your child application process as been cleared for admission processing.</p>
        <table class="table td-slip">
            <tr>
                <td width="40%">
                    <ul class="bordered-list">
                        <li> <strong>Reg. Code:</strong> {{ $registration->registration_code }} </li>
                        <li> <strong>Exam Date(preferred):</strong> {{  $registration->Screening->start_datetime }}</li>
                        <li> <strong>Class:</strong> {{  $registration->Grade->label }} </li>
                        <li> <strong>Exam Centre:</strong> <br> {{$registration->TestCenter->outlet_label }}</li>
                    </ul>
                </td>
                <td width="40%">
                     <ul class="bordered-list">
                        <li> <strong>Candidate Name:</strong> {{ $registration->Person->candidate_name }} </li>
                        <li> <strong>Gender:</strong> {{  $registration->Person->gender }} | <strong>DOB:</strong> {{  $registration->Person->birthday }}</li>
                        <li> <strong>Agent</strong> {{  $registration->contact_name }} </li>
                        <li>
                            <strong> Address: </strong>
                            <span>@foreach($registration->Person->Addresses  as $address)
                            {{  $address->address_prefix }} {{ $address->address_no }}, {{  $address->street_name }}, {{$address->Neighbourhood->neighbourhood_name}}, {{$address->Neighbourhood->City->city_name}}
                            {{$address->Neighbourhood->City->State->state_name}}
                            @endforeach
                        </li>
                    </ul>
                </td>
                <td width="15%">  <img src="{{ asset( $registration->avatar )}}" alt="{{  $registration->Person->gender }}" class="w-100"></td>
            </tr>
        </table>

    <p class="pd-2">
    <a href="{{ route('registrations.print', $registration->id) }}" class="btn btn-succcess btn-mail" target="_blank">Print Application form</a> <a class="btn btn-succcess btn-mail" href="{{ route('registrations.slip',$registration->id) }}" target="_blank">Print Registration Slip</a></p> <br>
    {{-- <br>   --}}
</div>

<br>
{{-- @component('mail::button', ['url' => 'http://www.silvervalleyschools.com/variations'])
Button Text
@endcomponent --}}

<p class="pd-2">
Warm Regards,<br>
{{ config('app.name') }}
</p>

@endcomponent
