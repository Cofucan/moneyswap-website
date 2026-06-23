 @extends('layouts.theme')
@section('page_title', 'Request A Quote')
@push('styles')
@push('styles')
<link rel="stylesheet" href="{{ asset ('lib/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset ('lib/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset ('lib/select2/select2.min.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset ('lib/datepicker/daterangepicker.css') }}"rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset ('css/form.css') }}"rel="stylesheet" media="all">
<link href="{{ asset('css/board.css') }}" rel="stylesheet">
<link href="{{ asset('css/pages.css') }}" rel="stylesheet">
<link href="{{ asset('lib/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush
@endpush

@section('content')


  <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>Request a Quote</li>
        </ol>
     

      </div>
 </section>
 

  <!--==========================
      What We Do Section
    ============================-->
    <section class="section-padding">
        <div class="container" data-aos="fade-up">
          <div class="row">
            <div class="col-lg-7">
            <div class="section-title">
              <h2>Request A Quote</h2>
            </div>
            @include('partials.alert')
                <div class="form-card">
                  <div clas="card-body">
                    <form method="POST" action="{{ route('briefs.store') }}" id="CreateBrief" class="php-email-form">
                      {{csrf_field()}}
                      {{-- <input type="hidden" name="enquiryable_type" class="form-control" id="contactus" > --}}
                        @include('briefs._form')
                        
                      <div class="p-t-20">
                        <button type="submit" class="btn btn--radius btn--green">Send Request</button>
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
 