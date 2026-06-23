@section('page_title', $employee->Profile->full_name)
@extends('layouts.theme')
@push('style')
<link href="{{ asset ('css/util.css') }}" rel="stylesheet">
<link href="{{ asset ('css/board.css') }}" rel="stylesheet">
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
@endpush

    @section('content')

    {{-- <section class="page-image">
        <img src= "{{ asset ('img/staffs.jpg')}}" class="img-fluid" alt="staffs Directory">
    </section> --}}
    <section>
            <div class="bread-crumb flex-w p-l-5 p-t-20 p-l-15-sm">

                    {{-- <div class="col-md-8 col-sm-6"> --}}
                      <a href="{{ url ('/')}}" class="s-text16">
                          <i class="fa fa-home"></i>
                          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                      </a>
              
                     <a href="{{ url ('employees') }}"class="s-text16">
                          Our Team
                          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                      </a>
              
                      <span class="s-text17">
                            {{$employee->Profile->full_name}}
                      </span>
                  </div>
        <div class="container  p-b-20">
          <div class="row">
            
                <div class="col-lg-9 page-body">
          
                               
                                        
                    <div class="row mt-4 mb-5">
                        <div class="col-md-5">
                            <img src="{{ asset ($employee->Profile->avatar) }}" alt="Profile Picture" class="avatar img-circle img-thumbnail">
                        </div>
                        <div class="col-md-7">
                          <h3 class="title">{{$employee->Profile->full_name}} <small>({{  $employee->Qualification->qualification }})</small></h3>  
                          <span> {{  $employee->Designation->designation }}</span><br>
                          <hr>
                          <div class="text-justify">
                            {!! $employee->Profile->bio !!}
                          </div>
                          
                        </div>
                    </div> 
                        
                </div>

                <div class="col-md-3 m-t-15 col-4 col-sm-3 side-menu">
                
                    
                    <div class="">
                       @include('calendarmanagement::events.pages_sidebar')
                        <hr>
                    
                        <p><i class="fa fa-phone"></i> :<b>{{$portal->telephone}}</b></p>
                        <p><i class="fa fa-envelope-open"></i>: {{$portal->email}}</p>
                        <hr>
                    </div>
                   
                </div>
        </div>
    </section>
@include('partials.admission')


  @endsection

