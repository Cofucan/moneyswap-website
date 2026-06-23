
@extends('layouts.theme')
@section('page_title',$page->headline)

@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset ('css/pages.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/career.css') }}">
@endpush
@section('content')

 	<!-- Title Page -->
   <section class="page-image">
    <img class="d-block w-100" src="{{ asset ($page->display_image) }}" alt="{{ $page->headline }}">
    </section>

     <section class="p-t-10 section-padding">
        <div class="container">
          <div class="row">

            <div class="col-md-9 col-sm-8 page-body p-r-50">
                <h2 class="title">{{ $page->headline }}</h2>

                <div class="text-justify">
                 {!! $page->body !!}
                </div>
                <hr>

                 <h3 class="line mb-4">Current Openings</h3>
                 @if($vacancies->count() > 0)
                @foreach ($vacancies as $vacancy)
                <div class="single-job mb-4  ">
                    <div class="col-md-6 job-text">
                        <h4><a href="{{ route('vacancies.details', $vacancy->slug) }}">{{ $vacancy->Designation->job_role }} </a></h4>                            
                    </div>                   
                </div>
                @endforeach
                @else 
                <h5> There are no Vacancies at the moment </h5>
                @endif


            </div>

            <div class="col-md-3 m-t-15 col-sm-4 side-menu">

                <div class="header">
                    <h5>Quick Links <i class="fa fa-list-ul"></i></h5>
                </div>
                <div class="quick-links">
                    <ul>
                        <li><a href="{{ url('/admissions') }}">Admission Policy</a></li>
                        <li><a href="{{ url('/admission/enquiry') }}">Admission Enquiry</a></li>
                        <li><a href="{{ url('/registrations/create') }}">Apply Online</a></li>

                        <li><a href="{{ url('/curricula') }}">Curriculum</a></li>
                        <li><a href="{{ url('/guidelines') }}">School Policy</a></li>

                        <li><a href="{{ url('/events') }}">Events Calendar</a></li>
                    </ul>
                </div>

                @include('calendarmanagement::events.pages_sidebar')


            </div>
        </div>
    </section>

  @endsection
