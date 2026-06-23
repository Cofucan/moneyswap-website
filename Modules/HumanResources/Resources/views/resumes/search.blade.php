
@extends('layouts.newtheme')
@section('page_title', 'Resume Banks' )

@push('style')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset ('css/pages.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset ('css/career.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/skoojob.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/jobs.css') }}">
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
@endpush
@section('content')

@section('menu')
   @include('partials.employee-header') 
@endsection

	@section('content')
	<section id="general-hero" class="d-flex align-items-center">

		<div class="container text-center"> 
			<h1 class="p-t-20 p-b-20">Resume Bank</h1>
		</div>
	  
	</section>


<section class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-md-12">  
        <div class="search-form mb-4">
          <h5>Start your Resume Search</h5>
          {{--  <form action="{{ route('vacancies.search') }}" method="POST" id="SearchVacancy" >  --}}
            <form action="#" method="POST" id="SearchVacancy" >
            {{csrf_field()}}

            <div class="form-row">
              <div class="col-md-5 col-sm-4 mb-2">
                <input type="text" name="department_id" class="form-control" placeholder="Job Role">
              </div>
              <div class="col-md-5 col-sm-4 mb-2">
                <select class="custom-select d-block w-100 select2{{ $errors->has('employment_type_id') ? ' is-invalid' : '' }}"  name="employment_type_id" id="employment_type_id" required>
                  <option value=""> Location</option>
                  {{-- @foreach($vacancyTypes as $key => $vacancyType)
                  <option value="{{  $key}}"> {{$vacancyType }} </option>
                  @endforeach   --}}
                </select>
                    @if ($errors->has('employment_type_id'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('employment_type_id') }}</strong>
                      </span>
                  @endif
              </div>
           
              <div class="col-md-2">
                <button class="btn btn-primary btn-block"> Search</button>
              </div>
            </div>              
          </form>
        </div>

        <div class="resume-bank">
          <h5 class="mb-2">Approved Resume</h5>
          <div class="row">
            @foreach ($resumes as $resume)
            <div class="col-md-3 mb-2">
              <a href="{{route('resumes.preview', $resume->reference_code)}}">
                <div class="cv-details">      
                  {{--  <div class="status"> Premium</div>     --}}
                  @if (!is_null($resume->Profile->passport_photo))
                    <img src="{{asset($resume->Profile->passport_photo) }}" alt="Passport"> 
                  @else
                  <img src="{{asset('images/passport.png') }}" alt="Passport">              
                  @endif      
                  <h6>{{$resume->Profile->full_name}}</h6>
                  {{--  <p><b>{{$resume->Designation->job_role}}</b></p>  --}}
                  <p>{{$resume->Education->Qualification->qualification}}                          
                    ({{$resume->Education->major}}) </p>
                  <span><b>Experience: </b>{{$resume->experience_years}} years</span>
                  <p class="location"><i class="fa fa-map-marker"></i> {{$resume->City->city_name}}, {{$resume->City->State->state_name}}</p>                
                </div>
              </a>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      {{-- <div class="col-md-3">
        <div class="featured">
          <div class="job-header">
              <h5 class="text-center">Recommended Resume</h5>
          </div>
          <div class="job-body">
            <div class="cv-horizontal">
              <div class="row">
                <div class="col-md-4 col-sm-4 col-5">
                  <div class="image-holder">
                    <img src="{{asset('images/passport.png') }}" alt="Passport" class="img-responsive">
                  </div>
                </div>
                <div class="col-md-8 col-sm-8 col-7">
                  <h5>Mr. Uchenna Bola</h5>
                  <h6>Educator <br> <small>(Chemistry, Physics and Biology)</small></h6>
                  <span>Lekki, Lagos</span>
                </div>
                 
                </div>
              </div>
            </div>
          </div>
      </div> --}}
      </div>
    </div>
    
  </div>
</section>


  
  @endsection
  
@push('scripts')

@endpush

