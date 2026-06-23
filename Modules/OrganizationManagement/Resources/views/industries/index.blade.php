@extends('layouts.theme')
@section('page_title', $page->headline)
@push('styles')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
<style>
    #industry-list{
        margin-bottom: 30px;
    }
    #industry-list img{
        height: 200px;
    }

    #industry-list .content {
        padding: 10px
    }
</style>
@endpush


@section('content')

 <section class="set-bg page-banner" data-setbg="{{ asset($page->display_image) }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
                <h2>{{$page->headline}}</h2>
            </div>
        </div>
    </div>
</section>


    <section class="section-padding"></section>

  <!--==========================
      What We Do Section
    ============================-->

    @foreach($industries as $industry)
      @if ($loop->index % 2 == 0)
        <section class="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1 px-3 py-3">
                        <div class="row">
                        <div class="col-lg-6">
                            <img src="{{asset ($industry->thumbnail)}}" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0 d-flex flex-column justify-content-center">
                        <h4>{{ $industry->label }}  </h4>
                            <p class="text-justify">{!! $industry->high_summary !!}</p>
                            <div class="row">

                            <div class="col-md-6">
                            <!-- <a href="{{ url('industry, $industry')}}" class="btn btn-danger btn-sm px-3 mt-4"><i class="bi-arrow-right"></i></a> -->

                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      @else
        <section class="about">
            <div class="container">
                <div class="row">

                    <div class="col-md-10 offset-md-1 px-3 py-3">
                        <div class="row" >
                        <div class="col-lg-6 order-lg-2 order-md-2 order-1">
                            <img src="{{asset ($industry->thumbnail)}}" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6 pt-lg-0 d-flex flex-column justify-content-center order-lg-1 order-md-1 order-2" id="content">
                            <h4>{{ $industry->label }}  </h4>
                            <p class="text-justify">{!! $industry->high_summary !!}</p>
                            <p>
                            <!-- <a href="{{ url('industry, $industry')}}" class="btn btn-danger btn-sm px-3 mt-4"><i class="bi-arrow-right"></i></a> -->

                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      @endif
    @endforeach

    <section class="section-padding"></section>

  @endsection

  @push('script')

  @endpush
