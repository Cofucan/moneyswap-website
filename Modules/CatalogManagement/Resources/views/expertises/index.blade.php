@section('page_title', $page->headline)
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
<style>
    #expertise-list{
        margin-bottom: 30px;
    }

    #expertise-list img{
        height: 200px;
    }

    #expertise-list .content {
        padding: 10px
    }
</style>
@endpush


@section('content')

 <section class="set-bg page-banner" data-setbg="{{ asset($page->display_image) }}">
  {{-- <div class="overlay"></div> --}}
  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
              
                  <!-- <h2>{{$page->headline}}</h2>  -->
            
          </div>
      </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-md-1 d-flex flex-column justify-content-center pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="200">
        <div class="section-title ">
            <h2 class="">{{$page->headline}}</h2>
            <p>{!! $page->body !!}</p>
        </div>    
      </div>     
    </div>
  </div>

  <div class="container">
    <div class="row">
        @foreach($expertises as $expertise)
        <div class="col-lg-4 col-md-6" data-aos="fade-up">
          <div class="service-item">
            <img src="{{asset ($expertise->thumbnail)}}" class="img-fluid" alt="">
              <div class="item-content">            
                <h5>{{$expertise->label}}</h5>
                <p class="text-justify">{!! $expertise->summary!!}</p>
                <a href="{{ url('expertise', $expertise->slug)}}" class="btn btn-danger btn-sm px-3"><i class="bi-arrow-right"></i> More </a>
              </div>
            </div>
        </div>
        @endforeach    

     

    </div>

  </div>
</section>

  <!--==========================
      What We Do Section
    ============================-->
    <section class="">
  
</section>
    @include('partials.cta')

  @endsection
  @push('script')

  @endpush
