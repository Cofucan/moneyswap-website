@section('page_title', 'Our Post')
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
<link href="{{ asset ('css/blog.css')}}" rel="stylesheet">
@endpush

    @section('content')

    <section class="set-bg page-banner" data-setbg="{{ asset('img/background/header-bg.jpg') }}">
  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
              
                  
            
          </div>
      </div>
  </div>
</section>

    <div class="page-title mt-3" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="current">Blog</li>
          </ol>
        </nav>
      </div>
    </div>

    <section class="section-padding">
        <div class="container">
            <div class="row">             
                <div class="col-md-9 col-sm-8">
                   
                    @if ($posts->count() > 0)
                        @foreach($posts as $post)
                    <div class="row mb-3"> 
                        @include('contentmanagement::posts._vertical-single')
                    </div>
                        @endforeach                        
                        @else
                         <h5 class="text-center text-danger mb-5 mt-5" >News not published</h5>                            
                        @endif 

                </div>

                {{-- <div class="col-md-3 m-t-15 col-sm-4">
                    <div class="side-menu">
                        <div class="header">
                            <h5>Quick Links <i class="fa fa-list-ul"></i></h5>
                        </div>
                        <div class="quick-links">
                            <ul>
                                <li><a href="{{ url('page/about') }}">About Us</a></li>
                                <li><a href="{{ url('/what-we-do')}}">What we do</a></li>
                                <li><a href="{{ url('get-involved') }}">Get Involved</a></li>
                                <li><a href="{{ url('member/requirments') }}">Become A Member</a></li>
                            </ul> 
                        </div>
                    </div>

               </div>  --}}
            </div>
        </div>
 </section>

  @endsection

@push('script')
  <script src="{{ asset ('plugins/popper.js/umd/popper.min.js')}}" ></script>
  <script src="{{ asset ('js/front.js')}}" ></script>
 @endpush
