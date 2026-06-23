@extends('layouts.admin')
@section('page_title', $instruction->headline)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link href="{{ asset ('css/admission.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<style>
    #program_loading{
        visibility:hidden;
    }
  .myDiv{
      display:none;
  }
</style>

@endpush


@section('content')


<nav aria-label ="breadcrumb mb-3">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
      <li class="breadcrumb-item"> <a href="{{ url('clients/manage') }}"> <i class="fa fa-list"></i> Clients</a></li>
      @if (isset($cohort))
      <li class="breadcrumb-item"><a href="{{ route ('cohorts.show', $cohort)}}"> {{ $cohort->label }}</a></li>
      @endif

      <li class="breadcrumb-item active" aria-current="page">  Norminate Client</li>

      <div class="ml-auto mr-0">

      </div>
  </ol>
</nav>
   <!--==========================
      Intro Section
    ============================-->




          <div class="row">
          <div class="col-md-10">
          <h3>{{$instruction->headline}}</h3>
            {!!$instruction->body!!}
            <hr>

              <form method="POST" action="{{ route('clients.store') }}" id="ClientForm" enctype="multipart/form-data">
                  {{csrf_field()}}
                <input id="agent_id" type="hidden" name="agent_id" value="{{ $agent->id }}">
                <span class="span">Sponsor : </span>
                <input id="agent_name" type="text" name="agent_name" value="{{ $agent->full_name }}" disabled>
                @include('clientmanagement::clients._form')
                <hr>

                <span class="span">Residential Address</span>
                <hr>
                <div class="form-row mb-2">
                    <div class="col-md-12 mb-3 form-group">
                      <div class="custom-control custom-radio custom-control-inline">
                          <input id="createAddress" name="address" type="radio" value="CreateAddress" class="custom-control-input" required>
                          <label class="custom-control-label" for="createAddress">Lives with Sponsor </label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                              <input id="newAddress" name="address" type="radio" value="NewAddress" class="custom-control-input" required>
                              <label class="custom-control-label" for="newAddress">Lives Elsewhere </label>
                      </div>
                    </div>
                    <div class="col-md-12">
                        <div id="showCreateAddress" class="myDiv">
                            <div class="form-group">
                                <label for="address_id">Addresses On File</label>
                                <select name="address_id" class="custom-select d-block w-100 select2 {{ $errors->has('address_id') ? ' is-invalid' : '' }}" id="address">
                                <option value=""> Attach Address</option>
                                    @foreach(Auth::user()->addresses as $address)
                                        <option value="{{$address->id}}"> {{$address->street_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="showNewAddress" class="myDiv">
                            @include('locationmanagement::addresses._form')
                        </div>
                    </div>
                </div>


                  <hr class="mb-4">
                <div class="row">
                    <div class="col-md-3 offset-md-9">
                        <button class="btn btn-primary btn-block" type="submit">Continue</button>
                    </div>
                </div>
              </form>
          </div>



  @endsection
  @push('scripts')
  <script>
    jQuery(document).ready(function($){
        $(".toggle_container").hide();
        $("button.reveal").click(function(){
            $(this).toggleClass("active").next().slideToggle("fast");
            if ($.trim($(this).text()) === 'Hide Address') {
                $(this).text('Add Address');
            } else {
                $(this).text('Hide Address');
            }

            return false;
        });
        $("a[href='" + window.location.hash + "']").parent(".reveal").click();
    });
</script>
<script>
    jQuery(document).ready(function($){
        $('input[type="radio"]').click(function(){
        var demovalue = $(this).val();
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
        });
     });
 </script>

  <script src="{{ asset ('plugins/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
         jQuery(document).ready(function($) {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2003,
                maxYear: 2011

            });
        });
    </script>

  <script src="{{ asset('plugins/anime/anime.js')}}"></script>
  <script src="{{ asset('js/select2.full.min.js')}}"></script>

  <script type="text/javascript">
    $('#cause').on('change',function(){
      var cause = $(this).val();
      if(cause){
        $.ajax({
          type:"GET",
          url:"{{url('causes/get-programs')}}?cause="+cause,
          beforeSend: function()
          {
            $('#program_loading').css("visibility", "visible");
          },
          success:function(res){
            if(res){

              $("#program").empty();
              $('#program_loading').css("visibility", "hidden");
              $.each(res,function(key,value)
              {
                $("#program").append('<option value="'+key+'">'+value+'</option>'); });
              }else
              {
                $("#program").empty();
              }
            } });
      }else{
        $("#program").empty();
      }
    });

  </script>


<script>
   jQuery(document).ready(function($) {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".file-upload").on('change', function(){
        readURL(this);
    });
});
</script>

@endpush
