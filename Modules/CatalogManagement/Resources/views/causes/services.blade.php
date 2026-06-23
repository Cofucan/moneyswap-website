@section('page_title', $page->content_title)
@extends('layouts.theme')
@push('style')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
<link href="{{ asset ('css/util.css') }}" rel="stylesheet">
@endpush


@section('content')

 <section class="page-image">
    <img class="d-block w-100" src="{{ asset ($page->display_image) }}" alt="{{ $page->content_title }}">
 </section>


  <!--==========================
      What We Do Section
    ============================-->
    <section class="page-content">
        <div class="container">
            <div class="row">


                <div class="col-md-9 col-sm-7 page-body">

                    <h2 class="text-center title">{{ $page->content_title }}</h2>
                    <hr>
                    <div class="content"> {!! $page->content_body !!}</div>

                    <div class="row">
                        @foreach ($causes as $cause)
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                @include('causes.single')
                            </div>
                        @endforeach
                      </div>
                </div>

                <div class="col-md-3 col-sm-3 side-menu">
                  @include('partials.quick-links')
                </div>
            </div>
        </div>
    </section>

    @include('partials.call-to-action')



  @endsection
  @push('script')

  @endpush
