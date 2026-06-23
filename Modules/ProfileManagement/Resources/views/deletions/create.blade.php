@extends('layouts.theme')
@section('page_title', '$page->headline')
@push('styles')
<link rel="stylesheet" href="{{ asset ('lib/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset ('lib/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset ('lib/select2/select2.min.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset ('css/form.css') }}"rel="stylesheet" media="all">
<link href="{{ asset('css/board.css') }}" rel="stylesheet">
<link href="{{ asset('css/pages.css') }}" rel="stylesheet">
<link href="{{ asset('lib/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<section class="set-bg page-banner" data-setbg="{{ asset($page->display_image) }}">
  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
              
            <h1 class="mt-5 mb-5 text-white">{{$page->headline}}</h1>
                  
            
          </div>
      </div>
  </div>
</section>
 

  <!--==========================
      What We Do Section
    ============================-->
    <section class="section-padding">
        <div class="container" data-aos="fade-up">
          <div class="row">
            <div class="col-md-12"></div>
            <div class="col-lg-6">
            <!-- <div class="section-title">
              <h2>{{$page->headline}}</h2>
            </div> -->
            <p class="text-justify">
            {!!$page->body!!} 

            </p>
            </div>
            <div class="col-lg-6">
              @include('partials.alert')
                <div class="form-card">
                  <div clas="card-body">
                    <form method="POST" action="{{ route('deletions.store') }}" id="CreateBrief" class="php-email-form">
                      {{csrf_field()}}
                      {{-- <input type="hidden" name="enquiryable_type" class="form-control" id="contactus" > --}}
                  <div class="input-group">
                    <input class="input--style-1" type="text" placeholder="Emain" name="email">
                  </div>

                  <div class="input-group">
                    <input class="input--style-1" type="text" placeholder="Telephone" name="telephone">
                  </div>
                  
                

                <div class="input-group">
                  <input class="input--style-1" type="phone" placeholder="Password" name="password">
                </div>
             
              
                <div class="form-group">
                    <label for="reason">Reason</label>
                    <textarea name="reason" class="form-control text-area" placeholder="Enter Enter Post content" > {!! old('reason') !!} </textarea>
                    @if ($errors->has('reason'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('reason') }}</strong>
                        </span>
                    @endif
                </div>  

                        
                      <div class="p-t-20">
                        <button type="submit" class="btn btn--radius btn--green">Submit</button>
                      </div>
                    </form>
                  </div>

              </div>
            </div>

            
        </div>
    </section>

  @endsection

  @push('scripts')
  <script src="{{ asset('lib/summernote/summernote-lite.min.js')}}"></script>
<script>
  $('#whyus').summernote({
    tabsize: 2,
    height: 80,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['insert', ['link']],
      ['view', ['fullscreen', 'help']]
    ]
  });
</script>
<script src="{{ asset('lib/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('lib/select2/select2.min.js')}}"></script>
<script src="{{ asset('lib/datepicker/moment.min.js')}}" defer></script>
<script src="{{ asset('lib/datepicker/daterangepicker.js')}}" defer></script>
<script src="{{ asset('js/form.js')}}" defer></script>
  @endpush
 