@extends('layouts.theme')
@section('page_title', 'Membership Registration' )
@push('styles')
<link rel="stylesheet" href="{{ asset ('lib/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset ('lib/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset ('lib/select2/select2.min.css') }}" rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset ('lib/datepicker/daterangepicker.css') }}"rel="stylesheet" media="all">
<link rel="stylesheet" href="{{ asset ('css/form.css') }}"rel="stylesheet" media="all">
<link href="{{ asset('css/board.css') }}" rel="stylesheet">
<link href="{{ asset('lib/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush
@section('content')

<section class="set-bg page-banner parallax" data-setbg="{{ asset($page->display_image) }}">
  {{-- <div class="overlay"></div> --}}
  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
                               
            
          </div>
      </div>
  </div>
</section>

 <!-- ======= Breadcrumbs ======= -->
 <div id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>{{$page->headline}}</li>
        </ol>
        <h2>{{$page->headline}}</h2>

      </div>
</div><!-- End Breadcrumbs -->

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
            <form method="POST" class="form-card">
                <div class="form-group">
                    <label for="transaction_channel_id" class="control-label mb-3"><b>Membership Type</b></label><br>
                    @foreach($membershiptypes as $key=> $membershiptype)
                    <div class="custom-control custom-radio custom-control-inline">
                    <input id="{{$key}}" name="membership_type_id" type="radio" value="{{$key}}" class="custom-control-input" required>
                    <label class="custom-control-label" for="{{$key}}">{{$membershiptype}}</label>
                    </div>
                    @endforeach
                
                </div>
            
                <div class="row row-space">
                    <div class="col-2">
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="First Name" name="first_name">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Last Name" name="last_name">
                        </div>
                    </div>
                </div>

                <div class="row row-space">
                    <div class="col-2">
                        <div class="input-group">
                            <input class="input--style-1" type="email" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                            <input class="input--style-1" type="phone" placeholder="Telephone" name="telephone">
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <input class="input--style-1" type="text" placeholder="Company Name" name="organization_name">
                </div>

                <div class="row row-space">
                    <div class="col-2">
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="organization_type_id">
                                    <option disabled="disabled" selected="selected">Business Type</option>
                                    @foreach($organizationtypes as $key=> $organizationtype)
                                    <option value="{{$key}}">{{$organizationtype}}</option>
                                    @endforeach
                                   
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                        <div class="rs-select2 js-select-simple select--no-search">
                                <select name="organization_type_id">
                                    <option disabled="disabled" selected="selected">Nature of Business</option>
                                    @foreach($industries as $key=> $industry)
                                    <option value="{{$key}}">{{$industry}}</option>
                                    @endforeach
                                   
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                    </div>
                </div>

               
                <div class="row row-space">
                    <div class="col-2">
                        <div class="input-group">
                            <input class="input--style-1 js-datepicker" type="text" placeholder="Company Active Since" name="active_at">
                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="gender">
                                    <option disabled="disabled" selected="selected">State Located</option>
                                    <option>Lagos</option>
                                    <option>Abuja</option>
                                    <option>Imo</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="overview">Why Choose Business</label>
                    <textarea name="overview" class="form-control text-area" placeholder="Enter Enter Post content" id="whyus"> {!! old('overview') !!} </textarea>
                    @if ($errors->has('overview'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('overview') }}</strong>
                        </span>
                    @endif
                </div>  
                <div class="p-t-20">
                    <button class="btn btn--radius btn--green" type="submit">Continue</button>
                </div>
            </form>
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
