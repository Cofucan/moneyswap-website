@extends('layouts.admin')
@section('page_title', $profile->name )
@push('styles')
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/client.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<style>
    #state_loading{
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

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
      <div class="col-md-8">
      <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        @if (Auth::user()->profile->role_id == 3 || Auth::user()->profile->role_id == 1)
          <a href="{{ url ('profiles/manage', $profile->role_category_id )}}" class="s-text16">
            Profiles
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
          </a>
        @endif

        <span class="s-text16">
          {{$profile->name}}
        </span>
        </div>
        <div class="col-md-4">
          @if ((!empty($profile->Employee->id)) && Auth::user()->profile->id == $profile->id)
          <a href="{{ route('employees.show', $profile->Employee) }}" class="btn btn-sm btn-primary">Employment Details </a>

          @endif
        </div>
    </div>
    <div class="container-fluid">

      <div class="row mt-4 mb-5">
        <div class="col-md-12">
          <h4 class="pull-left">  {{ $profile->full_name }} </h4>
        </div>
            <div class="col-sm-5 col-12 col-md-2"><!--left col-->
              <form action="{{ route('profiles.changephoto') }}" method="POST" enctype="multipart/form-data" >
                {{csrf_field()}}
                <input type="hidden" name="profile_id" value="{{ $profile->id }}">
                <div class="input-group mb-3">
                  <img src="{{ asset($profile->avatar) }}" alt="Profile Picture" class="avatar img-circle img-thumbnail">

                    <input type="file" name="avatar" class="form-control center-block file-upload {{ $errors->has('avatar') ? ' is-invalid' : '' }}" required>
                    <div class="input-group-append" id="button-addon4">
                      <button type="submit" class="btn btn-sm btn-success btn-block">
                         Save
                      </button>
                    </div>
                </div>
              </form>

              <table class="table table-bordered">


                <tr>
                    <td><strong>Gender:</strong>
                        {{ $profile->gender }}</td>
                </tr>
                <tr>
                    <td><strong>Date Of Birth: </strong><br>
                      {{ $profile->birthday }} ({{ $profile->age }} years old)</td>
                </tr>
                <tr>
                    <td><strong>Place of Birth:</strong> <br>{{ $profile->birthplace }}</td>
                </tr>

                <tr>
                    <td><strong>Primary Lang.: </strong><br>
                        {{ $profile->primary_language}} </td>
                </tr>
                <tr>
                    <td><strong>Religion: </strong><br>
                        {{ $profile->religion}} </td>
                </tr>


                @if(Auth::user()->profile_id == $profile->id)
                <tr>
                    <td> <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#profile">
                        <i class="fa fa-edit"></i> Update Record
                    </button></td>
                </tr>
                @endif

            </table>

            </div>
            <div class="col-sm-7 col-12 col-md-10 personal-info">
              <div class="card">
                <nav>
                  <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="telephones-tab" data-toggle="tab" href="#telephones" role="tab" aria-controls="telephones" aria-selected="false">Telephones</a>
                    @if ( $profile->role_id == 5)
                    <a class="nav-item nav-link" id="children-tab" data-toggle="tab" href="#children" role="tab" aria-controls="children" aria-selected="false">My Children</a>
                    {{-- <a class="nav-item nav-link" id="revenues-tab" data-toggle="tab" href="#revenues" role="tab" aria-controls="revenues" aria-selected="false">Transactions</a> --}}
                    @elseif ( $profile->Role->department_id == 3)
                    <a class="nav-item nav-link" id="subject-tab" data-toggle="tab" href="#subject" role="tab" aria-controls="subject" aria-selected="true">Employment Status</a>
                    @endif
                  </div>
                </nav>
                <div class="card-body">
                  <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    {{-- children-tab --}}
                    @if ( $profile->role_id == 5)
                    <div class="tab-pane fade" id="children" role="tabpanel" aria-labelledby="children-tab">
                        <div class="container">
                          <div class="row">
                            <div class="col-md-8 content_title">
                                <h4> Children </h4>
                                <p> Clients registered under your custody </p>
                            </div>

                            <div class="col-md-2">
                              <button type="button" class="btn btn-warning btn-block btn-sm mb-3 pull-right" data-toggle="modal" data-target="#link-child">
                                <i class="fa fa-user-plus"></i> Link Existing Client
                              </button>
                            </div>
                            <div class="col-md-2">
                              <a href="{{ route('clients.new', $profile->id) }}" class="btn btn-success btn-block btn-sm mb-3 pull-right" >
                                <i class="fa fa-user-plus"></i> New Client
                              </a>
                            </div>
                        </div>
                        <div class="row mt-4 mb-5">
                            @foreach ($profile->clients as $client)

                              <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-4">
                                <!-- small box -->
                                <div class="card px-2 py-3">
                                    <a href="{{ route('clients.show', $client->id) }}">
                                        <div class="row">
                                            <div class="col-md-12"> <h5>{{$client->name}}</h5> </div>
                                            <div class="col-md-5 col-5">
                                                <img src="{{asset ($client->Profile->avatar)}}" class="w-100"/>
                                            </div>
                                            <div class="col-md-7 col-7">
                                              <span><b>{{$client->admission_no }} </b> </span><br>
                                                <span><b>Class:</b> {{$client->class }}</span><br>
                                                <span><b>Client Type:</b> {{$client->ClientCategory->student_type }}</span><br>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            @endforeach
                        </div>
                        </div>
                    </div>
                    @endif

                    {{-- Profile info-tab --}}
                    <div class="tab-pane fade" id="students_info" role="tabpanel" aria-labelledby="students_info-tab">
                        <div class="row mt-4">
                          <div class="col-md-12">
                            <h5 class="pull-left">Profile Info</h5>
                            <button type="button" class="btn btn-primary btn-sm mb-3 pull-right" data-toggle="modal" data-target="#profile">
                                  <i class="fa fa-edit"></i> Edit
                              </button>
                              <table class="table table-bordered">
                                  <tr>
                                      <td width="33%"><strong>Gender:</strong>{{ $profile->gender }}</td>
                                      <td width="33%"><strong>DOB:</strong></span> {{ $profile->birthday }} ({{ $profile->age }} years old)</td>
                                  </tr>
                                  <tr>
                                      <td><strong>Marital Status</strong></span> {{ $profile->marital_status }}</td>
                                      <td><strong>Religion:</strong></span> {{ $profile->religion }}</td>
                                      <td><strong>Primary Language:</strong></span> {{ $profile->primary_language }}</td>
                                  </tr>

                                  <tr>
                                    <td colspan="3"><strong>About:</strong></span> {{ $profile->bio }}</td>
                                  </tr>

                              </table>

                          </div>
                        </div>
                    </div>

                    {{-- Contact tab --}}
                    <div class="tab-pane fade show active" id="telephones" role="tabpanel" aria-labelledby="telephones-tab">
                        <div class="row mt-4">
                          <div class="col-md-12">
                            <button type="button" class="btn btn-success btn-sm mb-3 pull-right" data-toggle="modal" data-target="#new-contact">
                                Add New Telephone
                              </button>
                              {{--editmodal begins--}}
                              <div class="modal fade" id="new-contact" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-md modal-dialog-centered">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                          <h4 class="modal-title text-center">Add Telephone</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                          </div>
                                          <div class="modal-body">
                                              <form method="POST" action="{{ route('telephones.store') }}" id="UpdateCOntact">
                                                  {{csrf_field()}}
                                                  <input type="hidden" name="phoneable_type" value="profile">
                                                  <input type="hidden" name="profile_id" value="{{$profile->id}}">
                                                @include('contactmanagement::telephones._form')

                                                  <div class="modal-footer">
                                                      <button class="btn btn-success" type="submit">Save </button>
                                                  </div>
                                              </form>

                                          </div>
                                      </div>
                                  </div>
                              </div>
                          {{-- modal ends--}}
                              <table class="table table-bordered">

                                  @foreach ($profile->Telephones as $telephone)
                                   @include('contactmanagement::telephones._tabledata')
                                  @endforeach

                              </table>

                          </div>
                        </div>
                    </div>
                    {{-- revenues-tab --}}
                    {{-- <div class="tab-pane fade" id="revenues" role="tabpanel" aria-labelledby="revenues-tab">

                            <div class="table-responsive">
                                <table class="table w-100" id="table">
                                        <thead>
                                            <tr>
                                                <th >Reference No</th>
                                                <th >Transaction Date</th>
                                                <th >Amount </th>
                                                <th >Transaction Type</th>
                                                <th >Transaction Method</th>
                                                <th > Status</th>
                                                <th > </th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($profile->Transactions as $transaction)
                                                <tr>
                                                    <td>{{$transaction->reference_code}}</td>
                                                    <td>{{$transaction->created_at}}</td>
                                                    <td>{{$transaction->currency }} {{  number_format($transaction->amount,2) }}</td>
                                                    <td>{{$transaction->transaction_type}}</td>
                                                    <td>{{$transaction->transaction_method}}</td>
                                                    <td>{{$transaction->status}}</td>
                                                    <td><a class="btn btn-warning btn-sm" href="{{ route('transactions.show', $transaction->id) }}"><i class="fa fa-print"></i> Detail </a></td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                    </div> --}}

                      <div class="tab-pane fade" id="subject" role="tabpanel" aria-labelledby="subject-tab">
                        @if ( $profile->Role->role_category_id == 2)
                        <div class="table-responsive">
                          <table class="table table-bordered">
                          <tr>
                              <td width="33%"><strong>ID Number: </strong> {{ $profile->employee->employee_code }}</td>
                              <td><strong>Employment Type:</strong></span> {{ $profile->employee->EmploymentType->employment_type }}</td>
                              <td width="33%"> <strong>Qualification:</strong></span> {{ $profile->employee->Qualification->label }}</td>
                          </tr>
                          <tr>
                                  <td><strong>Designation</strong></span> {{ $profile->employee->Designation->designation }}</td>
                                  <td><strong>Email:</strong></span> {{ $profile->employee->Profile->email }}</td>
                                  <td><strong>Telephone:</strong></span> {{ $profile->employee->Profile->telephone }}</td>

                          </tr>
                          <tr>
                              <td><strong>Organization:</strong></span> {{ $profile->employee->Organization->legal_name }} </td>
                              <td><strong>Department:</strong></span> {{ $profile->employee->Department->department_name }}</td>
                              <td><strong>Location</strong></span> {{ $profile->employee->Outlet->outlet_label }}</td>
                          </tr>
                          <tr>
                              <td><strong>Date Employed:</strong></span> {{ $profile->employee->hired_at }}</td>
                              <td><strong>Date Left:</strong></span> {{ $profile->employee->date_left }}</td>
                              <td><strong>Status:</strong> {{ $profile->employee->status }} </td>
                          </tr>
                          </table>
                        </div>
                        @endif

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
                      <form method="POST" action="{{ route('profiles.update',  $profile) }}" id="UpdateProfile">
                        {{csrf_field()}}
                        @method('PUT')

                        @include('profilemanagement::profiles._profileform')
                        <div class="modal-footer">
                            <button class="btn btn-success px-3" type="submit">Save </button>
                        </div>
                      </form>

                  </div>
                </div>
              </div>
            </div>
          {{-- profile modal ends--}}



                  {{-- profile modal begins--}}
                  <div class="modal fade" id="link-child" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                          <h4 class="modal-title text-center">Link Client </h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          </div>
                          <div class="modal-body">
                            <p>Enter the digits in the child's Admission Number</p>
                            <form method="POST" action="{{ route('clients.link') }}" id="UpdatePerson">
                                {{csrf_field()}}
                                  <input type="hidden" name="profile_id" value="{{ $profile->id }}">

                                  <div class="form-group">
                                    <label for="admission_number" class="label_control">Admission Number</label>
                                    <input type="number" class="form-control" name="admission_number" id="admission_number">
                                  </div>
                                  <div class="modal-footer">
                                      <button class="btn btn-success" type="submit">Link </button>
                                      {{--  <button class="btn btn-primary" type="reset">Reset</button>  --}}
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

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
<script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
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
<script>
  $(function() {
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
