@section('page_title', 'Start your volunteer journey with GMC')
@extends('layouts.theme')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link href="{{ asset ('css/util.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset ('plugins/daterangepicker/daterangepicker.css') }}">
  <style>
        #state_loading{
        visibility:hidden;
        }
        #city_loading{
        visibility:hidden;
        }
        #neighbourhood_loading{
        visibility:hidden;
        }
        #plan_loading{
            visibility:hidden;
        }
</style>

@endpush


@section('content')



   <!--==========================
      Intro Section
    ============================-->

    <!-- <section class="bg-title-page p-t-50 p-b-50 flex-col-c-m" style="background-image: url({{ asset ('images/invest.jpg') }});">
      <h2 class="l-text2 t-center mt-5 mb-5">
       {{ $page->content_title }}
      </h2>
    </section> -->

    <section class="section-padding">
      <div class="container">
          <div class="row">
              <div class="col-md-10 offset-md-1">
                  <div class="section-title">
                    <h4>{{ $page->headline }}</h4>
                  </div>
                  <div class="bg11 p-3 mb-4 ">
                    <h6 class=" mt-3">Already a member? <a href="{{url('login')}}" class="text-danger ml-2 text-underline"> <i class="fa fa-key">Sign in here</i> </a></h6>
                    <p class="">If you are a new member, kindly fill the form below to create your account and subscribe to an volunteer plan</p>
                    {{-- <hr> --}}
                    <h5 class=" text-uppercase"><b> Instructions:</b></h5>
                    <hr>
                    {!! $page->body !!}    
                </div>
         
                
                  
                    <form action="{{ route('volunteers.signup') }}" method="POST" id="CreateInvestor" enctype="multipart/form-data">
                      {{csrf_field()}}                      
                     
                      <h6>Personal Details</h6>
                      <hr>
                      @include('humanresources::volunteers._register')
                     
  
                      <h6 class="mt-3">Contact Address</h6>
                      <hr>        
                      @include('locationmanagement::addresses._form') 
                      
                      <h6 class="mt-3">Your Volunteer</h6>
                      <hr>   
                      @include('humanresources::volunteers._form')
                     
                      {{-- <div class="form-row"> 
                        <div class="col-md-6 form-group">
                          <label for="display_salary" class="control-label">Mode of Payments for R.O.I</label> <br>
                          <div class="custom-control custom-radio custom-control-inline">
                              <input id="Cash" name="display_salary" type="radio" value="1" class="custom-control-input">
                              <label class="custom-control-label" for="Cash">Cash</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                              <input id="Coin" name="display_salary" type="radio" value="0" class="custom-control-input">
                              <label class="custom-control-label" for="Coin">Coin</label>
                          </div>
                        </div>       
                      </div>  --}}
                    
                      <hr class="mb-4">
                      <button class="btn btn-primary" type="submit" name="status" value="Draft">continue</button>
                      {{-- <button class="btn btn-success" type="submit" name="status" value="Scheduled">Schedule </button> --}}
                    </form>
              </div>
          </div>
      </div>
    </section>
  @endsection
  @push('scripts')

  <script src="{{ asset('js/select2.js')}}"></script>
  <script>
    jQuery(document).ready(function($) {
      $('.select2').select2();
      });
  </script>
 
 <script type="text/javascript">
  $('#sponsor_state').on('change',function(){
  var sponsor_state = $(this).val();
  if(sponsor_state){
  $.ajax({
  type:"GET",
  url:"{{url('states/get-city-list')}}?state="+sponsor_state,
  beforeSend: function()
  {
    $('#city_loading').css("visibility", "visible");
  },
  success:function(res){
    if(res){

      $("#sponsor_city").empty();

      $('#city_loading').css("visibility", "hidden");

      $.each(res,function(key,value)
      {
        $("#sponsor_city").append('<option value="'+key+'">'+value+'</option>'); });
      }else
      {
        $("#sponsor_city").empty();
      }
    } });
  }else{
  $("#sponsor_city").empty();
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
