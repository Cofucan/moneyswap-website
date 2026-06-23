@extends('layouts.admin')
@section('page_title',  $client->name. ' Details')
@push('styles')
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/client.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<style>
    .myDiv{
        display:none;
    }
    #state_loading{
    visibility:hidden;
    }
    .card{
        overflow: hidden;
    }
</style>
@endpush
@section('content')

    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            @if (Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3 || Auth::user()->Profile->role_id == 16 )
                <li class="breadcrumb-item"> <a href="{{ url ('clients')}}"> Clients </a></li>
            @elseif(Auth::user()->Profile->role_id == 5 )
                <li class="breadcrumb-item"> </li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $client->name}}</li>

            <div class="ml-auto mr-0">
            @if(($client->status == 'Draft' || $client->status == 'Rejected') && $client->user_id == Auth::id())
                <a href="{{ url('kindreds/new', $client)}}" class="btn btn-sm btn-secondary px-3 mb-2"> Continue with Application</a>
            @endif

            </div>

        </ol>
    </nav>

    <div class="row mt-4">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="corner-ribbon">
                    {{$client->status}}
                </div>
                <div class="card-body">
                    {{-- <span class="strong"> Client Details </span> --}}
                    <div class="row ">
                        <div class="col-md-2 col-sm-3">
                            @include('clientmanagement::clients._changephoto')
                        </div>
                        <div class="col-md-9 col-sm-9 client-info">
                            <div class="pull-right mb-3">
                             @include('clientmanagement::clients._profilemodaledit')
                             @include('clientmanagement::clients.modaledit')
                            </div>
                             @include('clientmanagement::clients._tabularoverview')

                        </div>
                        <div class="col-md-12">
                           @include('clientmanagement::kindreds._list') 
                        </div>

                        <div class="col-md-12">
                            <div class="row mt-3 pl-3 pr-3">

                                <div class="col-md-6">
                                    <span class="strong">Sponsor Details</span>
                                    <p class="mt-3"> <b>Contact:</b> {{ $client->agent_name }}</p>
                                    <p> <b>Telephone: </b> {{ $client->Agent->Profile->telephone ?? 'N/A'}} </p>
                                    <p> <b>Email: </b> {{ $client->Agent->Profile->email ?? 'None'}} </p>
                                    <p> <b>Relationship: </b> {{ $client->relationship_type}} </p>
                                </div>
                            </div>

                            <div class="row mt-3 pl-3 pr-3">
                                <div class="col-md-8">
                                    <div class="section-head">
                                        <div class="pull-left">
                                            <div class="client-info ml-3">
                                                <span class="strong"> Address</span>
                                            </div>
                                        </div>
                                        <div class="pull-right">

                                                <a class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#newaddress">
                                                    Add Address
                                                </a>
                                                {{--editmodal begins--}}
                                                <div class="modal fade" id="newaddress" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title text-center">Add Address</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- modal ends--}}

                                        </div>
                                    </div>
                                    <table class="table">
                                        addresses
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- profile modal begins--}}
        <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('profiles.update',  $client->profile) }}" id="UpdateProfile">
                        {{csrf_field()}}
                        @method('PUT')

                        @include('profilemanagement::profiles._studentform')

                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Save </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
        {{-- modal ends--}}
    </div>




    </div>





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
                    // Define the toolbar streams as it is a more accessible solution.
                 toolbarGroups: [{
                  "name": "basicstyles",
                  "streams": ["basicstyles"]
                },
                {
                  "name": "links",
                  "streams": ["links"]
                },
                {
                  "name": "paragraph",
                  "streams": ["list", "blocks"]
                },
                {
                  "name": "document",
                  "streams": ["mode"]
                },
                {
                  "name": "insert",
                  "streams": ["insert"]
                },
                {
                  "name": "styles",
                  "streams": ["styles"]
                },
                {
                  "name": "about",
                  "streams": ["about"]
                }
              ],
              // Remove the redundant buttons from toolbar streams defined above.
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
