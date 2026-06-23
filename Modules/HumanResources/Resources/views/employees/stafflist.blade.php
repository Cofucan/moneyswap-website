@section('page_title', $page->headline)
@extends('layouts.theme')
@push('style')
<link href="{{ asset ('css/util.css') }}" rel="stylesheet">
<link href="{{ asset ('css/board.css') }}" rel="stylesheet">
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
@endpush

    @section('content')

    <section class="page-image">
        <img src= "{{ asset ($page->display_image)}}" class="img-fluid" alt="{{$page->headline}} image" title="{{$page->headline}}">
    </section>
    <section>
        <div class="container p-t-20 p-b-20">
          <div class="row">
            
                <div class="col-lg-12 page-body">
          
                <h3 class="title">{{$page->headline}}</h3>           
                
                    <hr>   
                            
                    <div class="row mt-4 mb-5">
                        @forelse ($employees as $employee)
    
                        <div class="col-lg-3 col-md-3 col-sm-6 mb-4">
                            <!-- small box --> 
                            <div class="employee-bg">
                                <a href="#">
                                    <div class="img-holder">
                                        <img src="{{asset ($employee->Profile->avatar)}}"/> 
                                    </div>
                                    
                                    <div class="col-md-12 employee-info">
                                        <h5>{{$employee->Profile->full_name}}</h5>
                                        
                                        <h6> {{  $employee->Designation->job_role }}</h6>
                                    </div>                                       
                                </a>
                            </div>
                        </div>
    
                        @endforeach

                    </div> 
                        <ul class="pagination">
                            {{$employees->links()}}
                       </ul>
                </div>

                {{-- <div class="col-md-3 m-t-15 col-4 col-sm-3 side-menu">
                
                    
                    <div class="">
                       @include('calendarmanagement::events.pages_sidebar')
                        <hr>
                    
                        <p><i class="fa fa-phone"></i> :<b>{{$portal->telephone}}</b></p>
                        <p><i class="fa fa-envelope-open"></i>: {{$portal->email}}</p>
                        <hr>
                    </div> --}}
                   
                </div>
        </div>
    </section>
@include('partials.admission')


  @endsection

