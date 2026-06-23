@section('page_title', 'Management')
@extends('layouts.theme')
@push('style')
<link href="{{ asset ('css/rrs.css') }}" rel="stylesheet">
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
@endpush

    @section('content')
    <img src=""> 
    <section class="page-image">
        <img src= "{{ asset ('img/about.jpg')}}" class="img-fluid" alt="Management" title="">
    </section>
    <section>
        <div class="container p-t-20 p-b-20">
          <div class="row">
                <div class="col-md-3 m-t-15 col-sm-4 side-menu">
                
                    <div class="side-menu-header">
                        <h5>Quick Links <i class="fa fa-list-ul"></i></h5>
                    </div>
                    <div class="quick-links">
                        <ul>
                            @include('partials.general-links')
                        </ul> 
                    </div>
 
                    @include('contentmanagement::events.pages_sidebar')
                
                
                </div>
            
                <div class="col-md-9 col-sm-8" id="directorate">
                  
                    <h4 class="title">Management</h4>     
                            
                       
                    <hr>   
                    @foreach($profiles as $profile)
                    @if ($loop->odd)
                    
                    <div class="director mb-4">                       
                            <div class="img-left">
                                <img src="{{ asset ($profile->passport)}}">                     
                            </div>
                                <h5>{{$profile->full_name}}</h5>
                                <p>{!! $profile->bio !!}</p> 
                           
                    </div>                     
                    @else
                    <div class="director mb-4">                       
                        <div class="img-right">
                            <img src="{{ asset ($profile->passport)}}">                     
                        </div>
                            <h5>{{$profile->full_name}}</h5>
                            <p>{!! $profile->bio !!}</p> 
                       
                </div>    
                    @endif    
                  
                    @endforeach                           
                    
                 
                </div>

        </div>
    </section>
@include('partials.admission')


  @endsection


