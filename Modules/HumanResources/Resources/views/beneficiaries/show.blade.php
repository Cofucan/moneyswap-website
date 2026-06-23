@extends('layouts.admin')
@section('page_title',  $donor->Profile->Person->candidate_name. ' Profile Page')
@push('styles')
<link rel="stylesheet" href="{{ asset ('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/reveal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/donor.css') }}">
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

            @if ( Auth::user()->profile->role_id == 1 )
            <a href="{{ url ('donors')}}" class="s-text16">
                Members
                 <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
             </a>
        @elseif ( Auth::user()->profile->role_id == 5 )
            <a href="{{ url ('profiles', Session::get('profile_id'))}}" class="s-text16">
                {{ Auth::user()->Person->name }}
                 <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
             </a>
        @endif

            <span class="s-text16">
                {{ $donor->Profile->Person->candidate_name }} Profile
            </span>
        </div>
      <div class="col-md-5 col-sm-12">

        <div class="page_button text-right">

        </div>
      </div>
    </div>
     <div class="row ">
        <div class="col-md-6 content_title">
            {{--  <span> <strong class="p-r-50">Referral Code: </strong>{{ $profile->User->referral_code }}</span>  --}}
        </div>

      </div>

    <div class="row mt-4 mb-5">
  		<div class="col-sm-5 col-12 col-md-2"><!--left col-->
            <form action="{{ route('people.changephoto') }}" method="POST" enctype="multipart/form-data" >
                {{csrf_field()}}
                <input type="hidden" name="person_id" value="{{ $donor->person_id }}">
                <div class="input-group mb-3">
                    <img src="{{ asset ($donor->Profile->Person->passport_photo) }}" alt="Profile Picture" class="avatar img-circle img-thumbnail">
                    <input type="file" name="passport_photo" class="form-control center-block file-upload {{ $errors->has('passport_photo') ? ' is-invalid' : '' }}" required>
                    <div class="input-group-append" id="button-addon4">
                    <button type="submit" class="btn btn-sm btn-primary btn-block">
                        {{ __('Change') }}
                    </button>
                    </div>
                </div>
            </form>
            <hr>
                <table class="table table-bordered">
                    <tr>
                        <td><strong>Donor Code:</strong><br>
                            {{ $donor->student_code }}</td>
                    </tr>
                    <tr>
                        <td><strong>Gender:</strong><br>
                            {{ $donor->Profile->Person->gender }}</td>
                    </tr>
                    <tr>
                        <td width="33%"><strong>DOB: </strong><br>
                            {{ $donor->Profile->Person->birthday }} </td>
                    </tr>
                    <tr>
                        <td width="33%"><strong>State of Origin:</strong> {{ $donor->Profile->Person->StateOfOrigin->state_name }}</td>
                    </tr>
                    {{-- <tr>
                        <td><strong>Place of birth:</strong></span> {{ $donor->Profile->Person->birthplace }}</td>
                        <td><strong>Religion:</strong></span> {{ $donor->Profile->Person->religion }}</td>
                        <td><strong>Primary Language:</strong></span> {{ $donor->Profile->Person->primary_language }}</td>
                    </tr>

                    <tr>
                      <td colspan="3"><strong>About:</strong></span> {{ $donor->Profile->Person->bio }}</td>
                    </tr> --}}

                </table>

        </div><!--/col-3--><!--/col-9-->
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
                        <form method="POST" action="{{ route('people.update',  $donor->Profile->Person->id) }}" id="UpdatePerson">
                            {{csrf_field()}}
                            @method('PUT')
                                <input type="hidden" name="id" value="{{$donor->Profile->Person->id}}">
                                @include('people._studentform')

                                <div class="modal-footer">
                                    <button class="btn btn-success" type="submit">Save </button>
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                </div>
                            </form>

                    </div>
                  </div>
                </div>
              </div>
            {{-- modal ends--}}

        <div class="col-md-10" id="tab">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="pull-left">  {{ $donor->Profile->Person->full_name }} <small>({{ $donor->Profile->Person->age }} years old)</small> </h4>
                    <button type="button" class="btn btn-primary btn-sm mb-3 pull-right" data-toggle="modal" data-target="#profile">
                        <i class="fa fa-edit"></i> Edit
                    </button>
                </div>
            </div>
            <hr>
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="false">Orders</a>
                    <a class="nav-item nav-link" id="nav-orders-tab" data-toggle="tab" href="#nav-orders" role="tab" aria-controls="nav-orders" aria-selected="false">Invoices</a>
                    <a class="nav-item nav-link" id="student_info-tab" data-toggle="tab" href="#student_info" role="tab" aria-controls="student_info" aria-selected="false">Milestone</a>
                    <a class="nav-item nav-link" id="nav-documents-tab" data-toggle="tab" href="#nav-documents" role="tab" aria-controls="nav-documents" aria-selected="false">Documents</a>

                </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                {{-- communication-tab --}}
                <div class="tab-pane fade" id="communication" role="tabpanel" aria-labelledby="communication-tab">
                    <div class="container">
                        <div class="row ">
                            @if ( Auth::user()->profile->role_id == 1 || Auth::user()->profile->role_id == 6  || Auth::user()->profile->role_id == 4)
                                <div class="col-md-3 offset-md-9">
                                    <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                                        <i class="fa fa-plus"></i> Compose Note
                                    </button>
                                </div>


                            @endif

                            {{-- modal begins--}}
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title text-center">Communication Note</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('communications.store') }}" id="CreateCommunication" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <input type="hidden" name="financial_year_id" value="{{ $currentyear->id }}" class="form-control" />
                                                <input type="hidden" name="donor_id" value="{{ $donor->id }}" class="form-control" />
                                                <div class="form-row">
                                                    <div class="col-md-5 form-group">
                                                        <strong for="donor_id"> Donor:</strong>
                                                        {{ $donor->Profile->Person->name }}
                                                    </div>
                                                    <div class="col-md-5 offset-md-2 mb-3 form-group">
                                                        {{-- <label class="control-label" for="value_date">Effective Date</label> --}}
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                            <input type="text" class="form-control{{ $errors->has('value_date') ? ' is-invalid' : '' }} pull-right" name="value_date"  value="">
                                                        </div>

                                                        @if ($errors->has('value_date'))
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('value_date') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @include('communications._form')

                                                <div class="modal-footer">
                                                <button class="btn btn-success" type="submit">Submit </button>
                                                <button class="btn btn-primary" type="reset">Reset Form</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- modal ends--}}
                            <table class="table">
                                    @foreach($donor->Communications as $communication)
                                    <div class="communication mt-2 col-md-12">
                                            @include('communications._singlelog')
                                    </div>
                                @endforeach
                            </table>

                            </div>
                        </div>
                </div>
                {{-- enrolment-tab --}}
                <div class="tab-pane fade " id="nav-enrolment" role="tabpanel" aria-labelledby="nav-enrolment-tab">
                    <div class="table-responsive">
                            <table class="table w-100" id="table">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th >Academic Term</th>
                                        <th >Level Level</th>
                                        <th >Classroom </th>
                                        <th >Seat No</th>
                                        <th >Status</th>
                                        <th >Outcome</th>
                                        <th >Date Enrolled</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donor->Enrolments as $enrolment)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$enrolment->Eligible->FinancialYear->fiscal_year }}</td>
                                            <td>{{$enrolment->Eligible->Level->level_title}}</td>
                                            <td>{{ $enrolment->Classroom->classroom_label }}</td>
                                            <td>{{$enrolment->seat_number}}</td>
                                            <td>{{$enrolment->status}}</td>
                                            <td>{{$enrolment->outcome}}</td>
                                            <td>{{$enrolment->created_at}}</td>
                                            <td><a class="btn btn-secondary btn-sm" target="_blank"  href="{{ route('enrolments.show', $enrolment->id) }}">Details</a>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>

                </div>
                {{-- donor info-tab --}}
                <div class="tab-pane fade" id="student_info" role="tabpanel" aria-labelledby="student_info-tab">
                    <div class="row mt-4">
                        <div class="col-md-10 donor-info">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="20%">Level Level</th>
                                        <td> {{$donor->Milestone->milestone_name}}</td>
                                    </tr>

                                    <tr>
                                        <th>Academic Term</th>
                                        <td> {{$donor->Milestone->FinancialYear->fiscal_year}}</td>
                                    </tr>
                                    <tr>
                                        <th>Year Admitted </th>
                                        <td>{{$donor->Milestone->admission_year}}</td>
                                    </tr>
                                    <tr>
                                        <th>Offer Date</th>
                                        <td>{{$donor->Milestone->offer_date}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status </th>
                                        <td>{{$donor->Milestone->status}}</td>
                                    </tr>
                                    <tr>
                                        <th>Remarks</th>
                                        <td>{{$donor->Milestone->remarks}}</td>
                                    </tr>

                                </table>
                        </div>

                    </div>
                </div>
                {{-- payments-tab --}}
                <div class="tab-pane fade show active" id="payments" role="tabpanel" aria-labelledby="payments-tab">

                        <div class="table-responsive">
                            <table class="table w-100" id="table">
                                    <thead>
                                        <tr>
                                            <th width="30%">Order Title</th>
                                            <th >Amount</th>
                                            <th >Payment Date</th>
                                            <th >Due Date</th>
                                            <th >Status</th>
                                            <th > </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($donor->Orders as $bill)
                                            <tr>
                                                    <td>{{$bill->order_title}}</td>
                                                    <td>{{ number_format($bill->OrderItems->sum('amount'),2)}}</td>
                                                    <td>{{ $bill->date_sent}}</td>
                                                    <td>{{$bill->due_date}}</td>
                                                    <td>{{ $bill->status }}</td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm" target="_blank" href="{{ route('orders.show',$bill->id) }}"> Details </a>
                                                    </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                </div>
                {{-- orders-tab --}}
                <div class="tab-pane fade" id="nav-orders" role="tabpanel" aria-labelledby="nav-orders-tab">
                    <div class="table-responsive">
                        <table class="table w-100" id="table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Reference No</th>
                                    <th >Amount Due</th>
                                    <th >Amount Paid</th>
                                    <th >Balance</th>
                                    <th >Payment Deadline</th>
                                    <th >Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donor->Invoices as $invoice)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><a target="_blank" href="{{ route('invoices.show',$invoice->id) }}">{{$invoice->ref_code }}</a></td>
                                        <td>{{ $invoice->currency }}{{ number_format($invoice->InvoiceItems->sum('amount'),2) }}</td>
                                        <td>{{ $invoice->currency }}{{ number_format($invoice->amount_paid,2) }}</td>
                                        <td>{{ $invoice->currency }}{{ number_format($invoice->balance,2) }}</td>
                                        <td>{{$invoice->due_date}}</td>
                                        <td>{{$invoice->status}}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- siblings tab --}}
                <div class="tab-pane fade" id="nav-documents" role="tabpanel" aria-labelledby="nav-documents-tab">
                    <div class="row mt-4 mb-5">
                        {{-- @foreach ($donors as $donor) --}}

                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-4">
                            <!-- small box -->
                            <div class="bg-ward">
                                {{-- <a href="{{ route('donors.show', $donor->id) }}">
                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                            <img src="{{asset ($donor->Profile->Person->passport_photo)}}"/>

                                        </div>
                                        <div class="col-md-7 col-7">
                                            <h5>{{$donor->Profile->Person->student_name}}</h5>
                                            <span><b>Roll No:</b> {{$donor->student_code }}</span><br>
                                            <span><b>Class:</b> {{$donor->Level->level_title }}</span><br>
                                            <span><b>Category:</b> {{$donor->ClientCategory->student_type }}</span><br>
                                            <span><b>Group:</b> {{$donor->Group->group_name }}</span><br>
                                        </div>
                                    </div>
                                </a> --}}
                            </div>
                        </div>

                        {{-- @endforeach --}}
                    </div>
                </div>

            </div>


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
