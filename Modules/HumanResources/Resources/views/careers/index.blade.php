 @section('page_title',$page->headline)
@section('page_title','career')
@extends('layouts.theme')
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset ('css/pages.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/career.css') }}">
@endpush
@section('content')

 	<!-- Title Page -->
   <section class="page-image">
        {{--  <img class="d-block w-100" src="{{ asset ($page->display_image) }}" alt="{{ $page->headline }}">  --}}
        <img class="d-block w-100" src="{{ asset ('img/news.jpg') }}" alt="curriculum">
    </section>

     <section class="p-t-10">
        <div class="container">
          <div class="row">

            <div class="col-md-9 col-sm-8 page-body p-r-50">
                {{--  <h2 class="title">{{ $page->headline }}</h2>  --}}
                <h3 class="title">Career</h3>

                <div class="text-justify">
                    {{--  {!! $page->body !!}  --}}
                    <p>We are committed to hiring, motivating and maintaining a dedicated workforce. We take staff and clients safety and wellness at the workforce as top priority. We strive to hiring the best fit by ensuring that potential clients meet the required qualifications, skills and experiences for quality service delivery. SVIC offers great career opportunities to clients that are very qualified, diligent, resourceful and demonstrates high competencies in their disciplines. We provide competitive salaries and packages to our staff.</p>

                    <p>Please send your application including resume to careers@silvervalleyschools.com</p>

                </div>
                <hr>

                {{--  <h3 class="line mb-4">Now Hiring</h3>  --}}

                <div class="single-job mb-4 d-lg-flex ">
                    <div class="row">
                        <div class="col-md-12 job-text">
                            <h4>Assistant Executive - Production/ Quality Control</h4>
                            <ul class="mt-4">
                                <li class="mb-3"></i> <b class="mr-3">Location:</b>new york, USA</li>
                                <li class="mb-3"> <b class="mr-3">Application Deadline:</b> Dec 11, 2018</li>
                                <li class="mb-3"> <b class="mr-3">Contract Term:</b> Fulltime</li>

                            </ul>

                        </div>

                        <div class="col-md-6">
                                <a href="#" class="btn btn-success mt-3 mr-4">View Details</a>
                            {{--  <a href="#" class="btn btn-danger mt-3 ">Apply Now</a>  --}}
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right"> <span>Share on </span><br>{!! $shared !!} </div>
                        </div>
                    </div>


                </div>




            </div>

            <div class="col-md-3 m-t-15  col-4 col-sm-3 side-menu">

                <div class="header">
                    <h5>Quick Links <i class="fa fa-list-ul"></i></h5>
                </div>
                <div class="quick-links">
                    <ul>
                        <li><a href="{{ url('/admissions') }}">Admission Policy</a></li>
                        <li><a href="{{ url('/admission/enquiry') }}">Admission Enquiry</a></li>
                        <li><a href="{{ url('/registrations/create') }}">Apply Online</a></li>

                        <li><a href="{{ url('/curricula') }}">Curriculum</a></li>
                        <li><a href="{{ url('/schoolpolices') }}"class="active">School Policy</a></li>

                        <li><a href="{{ url('/events') }}">Events Calendar</a></li>
                    </ul>
                </div>

                @include('calendarmanagement::events.pages_sidebar')


            </div>
        </div>
    </section>

  @endsection
