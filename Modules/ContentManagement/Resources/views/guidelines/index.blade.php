@section('page_title', $page->headline)
@extends('layouts.theme')
@push('style')
<link href="{{ asset ('css/pages.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/policies.css') }}">
@endpush
@section('content')

 	<section class="page-image">
        <img class="d-block w-100" src="{{ asset ($page->display_image) }}" alt="{{ $page->headline }}">
    </section>

    <section class="p-t-10 mb-5">
        <div class="container">
          <div class="row">
            <div class="col-md-3 m-t-15 side-menu">

                <div class="side-menu-header">
                    <h5>Quick Links <i class="fa fa-list-ul"></i></h5>
                </div>
                <div class="quick-links">
                    <ul>
                        @include('partials.general-links')
                    </ul>
                </div>

                @include('calendarmanagement::events.pages_sidebar')


            </div>

            <div class="col-md-9 page-body p-r-10">
                <h2 class="title">{{ $page->headline }}</h2>
                {{--  <h3 class="title">Policy</h3>             --}}

                <div class="text-justify">
                    {!! $page->body !!}

                </div>
                <hr>

                <div class="panel-stream" id="accordion3" role="tablist" aria-multiselectable="true">
                @foreach($guidelines as $guideline)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne3">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion3" href="#collapseOne3{{ $guideline->id }}" aria-expanded="true" aria-controls="collapseOne3{{ $guideline->id }}">
                                    {{$guideline->label}}
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne3{{ $guideline->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne3">
                            <div class="panel-body">
                                {!! $guideline->overview !!}

                            </div>

                        </div>
                    </div>
                @endforeach
                {{$guidelines->links()}}

                </div>

            </div>
        </div>
    </section>

      @include('partials.admission')


  @endsection
