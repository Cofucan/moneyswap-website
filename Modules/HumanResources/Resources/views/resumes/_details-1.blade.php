<div class="col-md-3" id="left-section">
    <div class="bio-data">
        <div class="text-center" id="profile-image">
        <img src="{{asset($resume->Profile->passport_photo)}}" alt="Passport" class="img-thumb">
        </div>
        <h5 class="mt-4">Contact</h5>
        @if ($resume->Profile->Addresses->count() > 0)
        <p> <i class="fa fa-map-marker"></i>:
        @foreach ($resume->Profile->Addresses as $address)
            <span>{{$address->address_prefix}} {{$address->address_no}}, {{$address->street_name}},
                {{$address->Neighbourhood->neighbourhood_name}}, {{$address->Neighbourhood->City->city_name}}, {{$address->Neighbourhood->City->State->state_name}}</span>
       @endforeach</p>
        @endif
        <p> <i class="fa fa-envelope"></i>:  {{ !empty($resume->Profile->DefaultEmail->contact_value) ? $resume->Profile->DefaultEmail->contact_value : 'None'}} </p>
        <p><i class="fa fa-phone"></i> :  {{ !empty($resume->Profile->DefaultPhone->contact_value) ? $resume->Profile->DefaultPhone->contact_value : 'None'}} </p>
        @foreach ($resume->Profile->socials as $social)
            <a href="{{ $social->SocialPlatform->url }}/{{$social->handle_name}}" target="_blank"><i class="fa fa-{{ $social->SocialPlatform->icon }}"></i> {{$social->handle_name}}  </a>
        @endforeach

        @if ($resume->Specializations->count() > 0)
        <h5 class="mt-5">Specialties</h5>
        <ul class="specialty">
            @foreach ($resume->Specializations as $spec)
            <li>{{ $spec->specialty }}</li>
            @endforeach
        </ul>
        @endif

        @if ($resume->Profile->Skillsets->count() > 0)
        <h5 class="mt-5">Skills</h5>
        <ul class="specialty">
            @foreach($resume->Profile->Skillsets as $skillset)
            <li>{{ $skillset->Skill->label }} <small>({{$skillset->proficiency}})</small></li>
            @endforeach
        </ul>
        @endif

        <h5 class="mt-5">Bio-Data</h5>
        <p> <b> Gender: </b> {{  $resume->Profile->gender }}</p>
        <p> <b> Date of Birth:</b>  {{  $resume->Profile->birthday }}</p>
        <p> <b> Marital Status: </b> {{  $resume->Profile->marital_status }}</p>
        <p> <b> Nationality: </b> {{  $resume->Profile->Nationality->citizen_title }}</p>
        <p> <b> Religion: </b> {{  $resume->Profile->religion }}</p>
        <p> <b> Primary Language: </b> {{  $resume->Profile->primary_language }}</p>


    </div>

</div>
<div class="col-md-9" >
    <div class="resume-title">
        <h4 class=""> {{$resume->Profile->candidate_name}} </h4>
        <h5 class=""> {{$resume->Designation->designation}}</h5>
    </div>
    <div id="right-section">
    <h5 class="bg-light">Career Objectives</h5>
    {!! $resume->career_objective !!}

    <div class="bio-data mt-5">
        <h5 class="bg-light">Work Experience</h5>
        <div class="mt-3">
            <ul class="timeline">
                @foreach($resume->Profile->Employments as $employment)

                <li>
                    <h6><b>{{$employment->Designation->job_role}}</b></h6>
                    <p><b> {{$employment->Organization->organization_name}}; </b>
                        {{$employment->Neighbourhood->City->city_name}}, {{$employment->Neighbourhood->City->State->state_name}}
                    </p>

					<a href="#" class="float-right"><b>Salary:</b> <small>{{$employment->currency}}</small> {{number_format($employment->salary)}}/ <small>{{$employment->payment_cycle}}</small></a>
                    <p>{{$employment->start_date}} – {{$employment->end_date}}</p>
                    @if (!is_null($employment->accomplishments))
                    <strong> <u> Accomplishments</u></strong> <br>
                        {!!$employment->accomplishments!!}
                    @endif
				</li>
            @endforeach
			</ul>
        </div>
    </div>


    <div class="bio-data mt-5">
        <h5 class="bg-light">Education</h5>
        <ul class="timeline">
            @foreach($resume->Profile->Educations as $education)
            <li>
                <h6><b>{{$education->Qualification->qualification}} {{$education->major}} </b></h6>
                <a href="#" class="float-right">{{$education->start_date}} – {{$education->completion_date}}</a>
                <p><b> {{$education->Organization->organization_name}}; </b>
                </p>
            </li>
            @endforeach
        </ul>
    </div>
</div>
</div>
