@extends('layouts.admin')
@section('page_title',  $employee->staff_name)
@push('styles')
<link href="{{ asset('lib/summernote/summernote-lite.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset ('css/client.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<style>
    #state_loading{
    visibility:hidden;
    }

    #live_loading{
    visibility:hidden;
    }
    #city_loading{
    visibility:hidden;
    }
    #sponsor_loading{
        visibility: hidden;
    }
    #qualification_loading{
    visibility:hidden;
    }

</style>
 <style>
    .myDiv{
        display:none;
    }
</style>
@endpush
@section('content')

        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"> <a href="{{ url('employees/manage') }}">Staff</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $employee->staff_name }}</li>
                <div class="ml-auto mr-0">
                @if ( Auth::user()->Profile->role_id == 3)
                    <div class="page_button">
                        @if(is_null($employee->date_left))
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-success">Edit <i class="fa fa-edit"></i></button></a>
                        @endif
                        <a href="{{ url('employees/manage') }}" class="btn btn-sm btn-primary">Employees  <i class="fa fa-table"></i></button></a>
                    </div>

                @endif
                </div>
            </ol>
        </nav>


    <div class="row mt-4 mb-5">
          <div class="col-sm-5 col-md-2"><!--left col-->
            <form action="{{ route('profiles.changephoto') }}" method="POST" enctype="multipart/form-data" >
                {{csrf_field()}}
                <input type="hidden" name="profile_id" value="{{ $employee->profile_id }}">
                <div class="input-group mb-3">
                    <img src="{{ asset ($employee->Profile->avatar) }}" alt="Profile Picture" class="avatar img-circle img-thumbnail">
                    <input type="file" name="avatar" class="form-control center-block file-upload {{ $errors->has('avatar') ? ' is-invalid' : '' }}" required>
                    <div class="input-group-append" id="button-addon4">
                    <button type="submit" class="btn btn-sm btn-primary btn-block">
                        {{ __('Change') }}
                    </button>
                    </div>
                </div>
            </form>
          

        </div>
        <div class="col-sm-7 col-12 col-md-10 client-info">
                <h4 class="mb-1">  {{ $employee->staff_name }} </h4>
                <div class="table-responsive">
                     <table class="table table-bordered">
                        <tr>
                            <td width="33%"><strong>ID Number: </strong> {{ $employee->employee_code }}</td>
                            <td><strong>Status:</strong> {{ $employee->status }} </td>
                        </tr>
                        <tr>
                        <td><strong>Employment Type:</strong> {{ $employee->type }}</td>
                            <td><strong>Email: </strong> {{ $employee->Profile->email }}</td>
                        </tr>

                        <tr>
                            <td width="33%"> <strong>Job Role: </strong> {{ $employee->position }}</td>
                            <td><strong>Telephone:</strong> {{ $employee->Profile->DefaultPhone->contact_value ?? 'None' }}</td>
                        </tr>
    
                       
                    </table>

                </div>
            </div>

        <div class="col-md-12 mt-4" id="tab">
            <div class="card">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="person-tab" data-toggle="tab" href="#Person" role="tab" aria-controls="Person" aria-selected="true">Personal Information</a>
                        <a class="nav-item nav-link" id="address-tab" data-toggle="tab" href="#Address" role="tab" aria-controls="Address" aria-selected="true">Contacts</a>

                      
                
                    </div>
                </nav>
                <div class="card-body">
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="Person" role="tabpanel" aria-labelledby="person-tab">

                                <strong class="pull-left">Personal Info </strong>
                                <button type="button" class="btn btn-primary pull-right btn-sm mb-3 " data-toggle="modal" data-target="#profile">
                                    <i class="fa fa-edit"></i> Edit
                                </button>

                                <table class="table table-bordered">
                                    <tr>
                                        <td width="50%"><strong>Full Name:</strong> {{ $employee->Profile->full_name }}</td>
                                        <td width="50%"><strong>Gender:</strong> {{ $employee->Profile->gender }}</td>

                                    </tr>
                                    <tr>
                                        <td><strong>Date of Birth:</strong>{{ $employee->Profile->birthday }}</td>
                                        <td><strong>Marital Status:</strong> {{ $employee->marital_status }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Bio: </strong> <br>
                                            {!!$employee->profile->bio!!}
                                        </td>
                                    </tr>

                                </table>
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
                                            <form method="POST" action="{{ route('profiles.update',  $employee->Profile->id) }}" id="UpdatePerson">
                                            {{csrf_field()}}
                                            @method('PUT')
                                                @include('profilemanagement::profiles._employeeform')

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

                        {{-- Address Tab--}}
                        <div class="tab-pane fade" id="Address" role="tabpanel" aria-labelledby="address-tab">
                            <strong class="pull-left text-muted">Address</strong>
                            {{-- <a class="btn btn-primary pull-right btn-sm" href="{{ route('employees.edit',$employee->id) }}"><i class="fa fa-edit"></i> </a> --}}

                          
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>





@endsection

@push('scripts')
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript">

</script>


<script type="text/javascript">

</script>
    <script>
        jQuery(document).ready(function($) {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                locale: {
                format: 'YYYY/MM/DD'
                }
            });
        });
    </script>
    <script>
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

          $('#state').on('change',function(){
        var state = $(this).val();
        if(state){
        $.ajax({
        type:"GET",
        url:"{{url('states/get-city-list')}}?state="+state,
        beforeSend: function()
        {
          $('#city_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){

            $("#city").empty();

            $('#city_loading').css("visibility", "hidden");

            $.each(res,function(key,value)
            {
              $("#city").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#city").empty();
            }
          } });
        }else{
        $("#city").empty();
        }
      });

    </script>

    <script>

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

    </script>

<script src="{{ asset('lib/summernote/summernote-lite.min.js')}}"></script>
<script>
  $('#textarea').summernote({
    tabsize: 2,
    height: 400,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });
</script>

 @endpush
