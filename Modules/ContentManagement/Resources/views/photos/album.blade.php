@section('page_title', 'Photo Studio')
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/compact-gallery.css')}}">
<link href="{{ asset ('css/gallery.css')}}" rel="stylesheet">
@endpush
@section('content')
<section class="set-bg page-banner parallax" data-setbg="{{ asset($album->cover) }}">
  {{-- <div class="overlay"></div> --}}
  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
                               
            
          </div>
      </div>
  </div>
</section>
 <div id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{url('/albums')}}">Media</a></li>
          <li>{{ $album->label }}</li>
        </ol>
        <h2>{{ $album->label }} Photos</h2>

      </div>
</div><!-- End Breadcrumbs -->

        <!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>{{ $album->label }}</h2>
          <p> Photos</p>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
        @foreach($photos as $photo)      
            @include('contentmanagement::photos.single')
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{asset($photo->file_path)}}" class="img-fluid gallery-thumb" alt="">
              <div class="portfolio-info">
                <p>Infrastructure</p>
                <a href="{{asset($photo->file_path)}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="{{$photo->Album->label}}"><i class="bx bx-plus"></i></a>
              </div>
            </div>
          @endforeach
          
        </div>

      </div>
    </section><!-- End Portfolio Section -->


    
 <!-- ======= Cta Section ======= -->

 @include('partials.cta')

<!-- End Cta Section -->

@endsection
@push('scripts')
@include('contentmanagement::photos.script')
@endpush
