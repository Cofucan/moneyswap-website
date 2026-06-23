 @extends('layouts.theme')
 @section('page_title',$vacancy->vacancy_title)
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset ('css/pages.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/career.css') }}">
@endpush
@section('content')

     <section class="job-single-content p-t-50">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-8">
                    <div class="main-content">
 

                        <div class="job-text">
                            <h4 class="mb-3">{{ $vacancy->vacancy_title }} 
                             
                            </h4>
                                <ul>
                                    <div class="row mb-4">
                                
                                        <div class="col-md-6">
                                            <li class="mb-1"> <b class="mr-3">Vacancy Ref: </b> {{ $vacancy->vacancy_ref }}</li>
                                            <li class="mb-1"> <b class="mr-3">Employment Type: </b> {{ $vacancy->EmploymentType->employment_type }}</li>
                                            <li class="mb-1"> <b class="mr-3">Minimum Education: </b> {{ $vacancy->Qualification->label }}</li>
                                            <li class="mb-1"> <b class="mr-3">Minimum Experience Year: </b> {{ $vacancy->years_of_experience }}</li>
                                            <li class="mb-1"> <b class="mr-3">Salary: </b> {{ $vacancy->salary }}</li>
                                        </div>
                                         <div class="col-md-6">
                                            <li class="mb-1"> <b class="mr-3">Application Deadline:</b> {{ $vacancy->close_at }}</li>
                                            <li class="mb-1"> <b class="mr-3">Total Positions:</b> {{ $vacancy->employees_needed }}</li>
                                            <li class="mb-1"> <b class="mr-3">Available Positions: </b> {{ $vacancy->available_slots }}</li>
                                            <li class="mb-1"> <b class="mr-3">Anticipated Resumption :</b> {{ $vacancy->expected_start_date }}</li>
                                        </div>
                                            
                                    </div>
                                </ul>
                            <hr>
                        </div>

                        {{--  <div class="col-md-6">
                                <a href="#" class="btn btn-success mt-3 mr-4">View Details</a>
                            <a href="#" class="btn btn-danger mt-3 ">Apply Now</a>
                        </div>  --}}



                        <div class="single-content2">
                            <h6>Description</h6>
                            <div class="text-justify"> {!!  $vacancy->description !!}</div>
                        </div>
                       
                        @if (!empty($vacancy->responsibilities))
                            <div class="single-content4 mb-4">
                                <h6>Duties & responsibility</h6>
                                <div class="text-justify">  {!!  $vacancy->responsibilities !!}</div>
                            </div>                            
                        @endif
                        @if (!empty($vacancy->other_requirements))
                        <div class="single-content4 mb-4">
                            <h6>Other Requirements</h6>
                            <div class="text-justify"> {!!  $vacancy->other_requirements !!}</div>
                            
                        </div>
                            
                        @endif
                        <div class="row mb-4">
                            <div class="col-md-6 ">
                                <div class="single-content6">
                                     
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-content6">

                                </div>
                            </div>

                        </div>


                         <hr>


                        <div class="pull-right mb-3"> <span>Share on </span><br>{!! $shared !!} </div>
 
                    </div>
                </div>
              <div class="col-md-3 m-t-15 offset-md-1 col-4 col-sm-3 side-menu">

                {{-- <div class="header">
                    <h5> <i class="fa fa-list-ul"></i></h5>
                </div>
                <div class="quick-links">
                    <ul>
                        <li><a href="{{ url('/admissions') }}">Admission Policy</a></li>
                        <li><a href="{{ url('/admission/enquiry') }}">Admission Enquiry</a></li>
                        <li><a href="{{ url('/registrations/create') }}">Apply Online</a></li>

                        <li><a href="{{ url('/curricula') }}">Curriculum</a></li>
                        <li><a href="{{ url('/schoolpolices') }}">School Policy</a></li>

                        <li><a href="{{ url('/events') }}">Events Calendar</a></li>
                    </ul>
                </div> --}}

                {{-- @include('calendarmanagement::events.pages_sidebar') --}}


            </div>
            </div>
        </div>
    </section>

  @endsection
