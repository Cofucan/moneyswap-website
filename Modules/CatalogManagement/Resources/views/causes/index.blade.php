@extends('layouts.theme')
@section('page_title', $page->headline)
@push('styles')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
<style>
    #cause-list{
        margin-bottom: 30px;
    }

    #cause-list img{
        height: 200px;
    }

    #cause-list .content {
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

                  <h2>{{$page->headline}}</h2>

          </div>
      </div>
  </div>
</section>

{{-- <section  class="d-flex align-items-center section-padding about">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">

            <h4 class="text-uppercase mb-3">{{$page->headline}}</h4>
            <div class="about-content text-justify">
                {!! $page->body !!}
            </div>
      </div>

    </div>
  </div>
</section> --}}
      <section class="section-padding"></section>

  <!--==========================
      What We Do Section
    ============================-->
    @foreach($causes as $cause)
      @if ($loop->index % 2 == 0)
      <section class="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                        <div class="col-lg-6">
                            <img src="{{asset ($cause->thumbnail)}}" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0 d-flex flex-column justify-content-center">
                        <h4>{{ $cause->label }}  </h4>
                            <p class="text-justify">{!! $cause->overview !!}</p>
                            <div class="row">

                            <div class="col-md-6">
                                @if(!empty($cause->button_url))
                                <a href="{{ url($cause->button_url)}}" class="btn btn-danger btn-lg px-3 ">{{ $cause->button_text }}</a>
                                @endif
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      @else
      <section class="section-bg about">
            <div class="container">
                <div class="row">

                    <div class="col-md-10 offset-md-1 px-3 py-3">
                        <div class="row" >
                        <div class="col-lg-6 order-lg-2 order-md-2 order-1">
                            <img src="{{asset ($cause->thumbnail)}}" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6 pt-lg-0 d-flex flex-column justify-content-center order-lg-1 order-md-1 order-2" id="content">
                            <h4>{{ $cause->label }}  </h4>
                            <p class="text-justify">{!! $cause->overview !!}</p>

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

      @endif
      @endforeach

      <section class="section-padding"></section>

    <section class="section-padding set-bg" data-setbg="{{ asset('img/background/theme-bg.jpg') }}">
    <div class="container ">
      <div class="section-title mb-5">
        <h4 class="text-upppercase">How to get Involved</h4>
      </div>
      <div class="row mt-2">
        <div class="col-md-10 offset-md-1">
          <div class="row">
              <div class="col-md-4 col-lg-4 col-sm-6 mb-5 mb-lg-0 text-center">
                  <div class="box-border-bg" data-aos="fade-up" data-aos-delay="100">
                      <a href="{{ url('ples/create') }}">
                        <img src="{{ asset ('img/icons/donate.png') }}" alt="" class="icon-lg">
                        <h4 class="link-title mt-3">Donate Now</h4>
                      </a>
                  </div>
              </div>

              <div class="col-md-4 col-lg-4 col-sm-6 mb-5 mb-lg-0 text-center">
                  <div class="box-border-bg" data-aos="fade-up" data-aos-delay="100">
                      <a href="{{ url('members/home') }}">
                        <img src="{{ asset ('img/icons/newmember.png') }}" alt="" class="icon-lg">
                        <h4 class="link-title mt-3">Become A Member</h4>
                      </a>
                  </div>
              </div>

              <div class="col-md-4 col-lg-4 col-sm-6 mb-5 mb-lg-0 text-center">
                  <div class="box-border-bg" data-aos="fade-up" data-aos-delay="100">
                      <a href="{{url('volunteers/create')}}">
                        <img src="{{ asset ('img/icons/volunteer.png') }}" alt="" class="icon-lg">
                        <h4 class="link-title mt-3">Volunteer</h4>
                      </a>
                  </div>
              </div>
          </div>
        </div>
    </div>
    </div>
</section>



  @endsection
  @push('script')

  @endpush
