@section('page_title', $page->headline)
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/util.css') }}" rel="stylesheet">
<link href="{{ asset ('css/board.css') }}" rel="stylesheet">
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
@endpush

    @section('content')

    <section class="set-bg page-banner" data-setbg="{{ asset($page->display_image) }}">
        {{-- <div class="overlay"></div> --}}
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
                    
                        <h2>{{$page->headline}}</h2> 
                  
                </div>
            </div>
        </div>
      </section>
    <section>
        <div class="container p-t-20 p-b-20">
          <div class="row">
            
                <div class="col-lg-12 page-body">
          
                <h3 class="title">{{$page->headline}}</h3>           
                
                    <hr>   
                            
                    <div class="row mt-4 mb-5">
                        @forelse ($members as $member)
    
                        <div class="col-lg-3 col-md-3 col-sm-6 mb-4">
                            <!-- small box -->
                            <div class="member-bg">
                                <a href="#">
                                    <div class="img-holder">
                                        <img src="{{asset ($member->Profile->passport)}}"/> 
                                    </div>
                                    
                                    <div class="col-md-12 member-info">
                                        <h5>{{$member->Profile->full_name}}</h5>
                                        
                                        <h6> {{  $member->Designation->job_role }}</h6>
                                    </div>                                       
                                </a>
                            </div>
                        </div>
    
                        @endforeach

                    </div> 
                        <ul class="pagination">
                            {{$members->links()}}
                       </ul>
                </div>

                   
                </div>
        </div>
    </section>



  @endsection

