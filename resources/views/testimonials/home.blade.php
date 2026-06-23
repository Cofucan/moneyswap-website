@extends('layouts.admin')
@section('page_title', 'Events Manager')
@push('styles')
<link rel="stylesheet" href="{{ asset ('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/tab.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/daterangepicker/daterangepicker.css') }}">
<style>
    .myDiv{
        display:none;
    }  
    #state_loading{
    visibility:hidden;
    }
    
</style>
@endpush
@section('content')

    <div class="container-fluid">
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-7 col-sm-12">
                <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>        

                <span class="s-text17">
                    Events
                </span>
            </div>
            <div class="col-md-5 col-sm-12">
                
            </div>
        </div>
    </div>

    <div id="tabs" class="mt-3">                 
      <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#events-tab" role="tab" aria-controls="events-tab">Events</a>
          </li>
         
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#sessions-tab" role="tab" aria-controls="sessions-tab">Events Session</a>
          </li>

          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#participant-tab" role="tab" aria-controls="participant-tab">Participants</a>
          </li> 
         
      </ul>
          
      <div class="tab-content">
          <div class="tab-pane active" id="events-tab" role="tabpanel">
              <div class="row p-t-4">
                  <div class="col-md-12 section-head">
                      <div class="pull-left candidate-info ml-3">
                          <span class="strong ">Events</span>
                      </div>           
                        <div class="pull-right">
                            <a href="{{ url('events/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
                        </div>       
                  </div>
                  <div class="col-md-12 mt-4">
                       @include('events._table')
                  </div>
              </div>
              
          </div>          
        
          <div class="tab-pane" id="sessions-tab" role="tabpanel">
              <div class="row">
                  <div class="col-md-9">
                      <strong>Events Sessions</strong>           
                  </div>
                  <div class="col-md-3 section-head bg-light">   
                          <a class="btn btn-primary btn-sm" href="{{ url('eventsessions/create') }}">New Session</a>                                   
                  </div>
                  <div class="col-md-12">                                  
                    <div class="table-responsive">
                        @include('eventsessions._table')
                    </div>
                  </div> 
              </div>  
          </div> 

          <div class="tab-pane" id="participant-tab" role="tabpanel">
              <div class="section-head">
                  <div class="row no-gutters">
                    <div class="col-md-8 candidate-info">
                        <span class="strong ">Participants </span>
                    </div>
                  </div>
              </div>    
              <div class="row mt-4 mb-4">
                <div class="col-md-12">
                  @include('participants._table')
                </div>         
              </div>  
              
          </div> 

      </div>
      
          
  {{--  </div>    --}}

@endsection

@push('scripts')

<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    
   <script>
      jQuery(document).ready(function($) {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                locale: {
                format: 'YYYY/MM/DD'
                }
            });
        });
    jQuery(document).ready(function($){
        $(".toggle_container").hide();
        $("button.reveal").click(function(){
            $(this).toggleClass("active").next().slideToggle("fast");

            if ($.trim($(this).text()) === 'Hide') {
                $(this).text('Add More');
            } else {
                $(this).text('Hide');
            }

            return false;
        });
        $("a[href='" + window.location.hash + "']").parent(".reveal").click();
    });

    jQuery(document).ready(function($) {
            $('input[name="value_date"]').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                minDate: moment().subtract(3, 'day'),
                maxDate: moment(),
                locale: {
                format: 'YYYY-MM-DD'
                }
            });
        });
        jQuery(document).ready(function($){


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
        jQuery(document).ready(function($) {
        $('.select2').select2();
        });
</script>
 
        <script>
            CKEDITOR.replace("details",
                {
                    height: 100,
                    // Define the toolbar groups as it is a more accessible solution.
                 toolbarGroups: [{
                  "name": "basicstyles",
                  "groups": ["basicstyles"]
                },
                {
                  "name": "links",
                  "groups": ["links"]
                },
                {
                  "name": "paragraph",
                  "groups": ["list", "blocks"]
                },
                {
                  "name": "document",
                  "groups": ["mode"]
                },
                {
                  "name": "insert",
                  "groups": ["insert"]
                },
                {
                  "name": "styles",
                  "groups": ["styles"]
                },
                {
                  "name": "about",
                  "groups": ["about"]
                }
              ],
              // Remove the redundant buttons from toolbar groups defined above.
              removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
                });
        </script>

<script type="text/javascript">
    $('#country').on('change',function(){
    var country = $(this).val();
    if(country){
      $.ajax({
        type:"GET",
        url:"{{url('countries/get-state-list')}}?country="+country,
        beforeSend: function()
        {
          $('#state_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){
  
            $("#state").empty();
  
            $('#state_loading').css("visibility", "hidden");
  
            $.each(res,function(key,value)
            {
              $("#state").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#state").empty();
            }
          } });
    }else{
      $("#state").empty();
    }
  });
  </script>
 @endpush
