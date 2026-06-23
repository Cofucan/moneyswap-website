@extends('layouts.admin')
@section('page_title', $member->candidate_name. ' Member Details Page' )
@push('styles')
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
    <div class="col-md-7 col-sm-12">
        <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        @if ( Auth::user()->Profile->role_id == 11 )
        <a href="{{ url ('members/manage')}}" class="s-text16">
            Members
             <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
         </a>
        @elseif ( Auth::user()->Profile->role_id == 5 )
            <a href="{{ url ('profiles', Session::get('profile_id'))}}" class="s-text16">
                {{ Auth::user()->Profile->name }}
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
        @endif

        <span class="s-text16">
            {{ $member->candidate_name }}
        </span>
    </div>
  <div class="col-md-5 col-sm-12">
   @include('membermanagement::members._action')
  </div>
</div>

      <div class="row mt-4 mb-5">
        <div class="col-md-12">
          <h4 class="pull-left"> {{ $member->candidate_name }} </h4>
        </div>
            <div class="col-sm-5 col-12 col-md-2"><!--left col-->
                @if (Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16)
                <form action="{{ route('profiles.changephoto') }}" method="POST" enctype="multipart/form-data" >
                {{csrf_field()}}
                <input type="hidden" name="profile_id" value="{{ $member->profile_id }}">
                <div class="input-group mb-3">
                    <img src="{{ asset ($member->Profile->avatar) }}" alt="Profile Picture" class="avatar img-circle img-thumbnail">
                    <input type="file" name="avatar" class="form-control center-block file-upload {{ $errors->has('avatar') ? ' is-invalid' : '' }}" required>
                    <div class="input-group-append" id="button-addon4">
                    <button type="submit" class="btn btn-sm btn-primary btn-block">
                        {{ __('Change') }}
                    </button>
                    </div>
                </div>
            </form>
               @else
               <img src="{{ asset ($member->Profile->avatar) }}" alt="Profile Picture" class="avatar img-circle img-thumbnail">
               @endif

              <table class="table table-bordered">


                <tr>
                    <td><strong>Gender:</strong>
                        {{ $member->profile->gender }}</td>
                </tr>
                <tr>
                    <td><strong>Date Of Birth: </strong><br>
                      {{ $member->profile->birthday }} ({{ $member->profile->age }} years old)</td>
                </tr>
                <tr>
                    <td><strong>Place of Birth:</strong> <br>{{ $member->profile->birthplace }}</td>
                </tr>

                <tr>
                    <td><strong>Primary Lang.: </strong><br>
                        {{ $member->profile->primary_language}} </td>
                </tr>
                <tr>
                    <td><strong>Religion: </strong><br>
                        {{ $member->profile->religion}} </td>
                </tr>

                <tr>
                    <td><strong>Nationality:</strong> {{ $member->profile->nationality }}</td>
                </tr>

                @if (Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16)

                <tr>
                    <td> <a class="btn btn-primary btn-sm" href="{{ route('profiles.show', $member->profile)}}">
                         Update Record
                    </a></td>
                </tr>
                @endif

            </table>

            </div>
            <div class="col-sm-7 col-12 col-md-10 personal-info">
              <div class="card">
                <nav>
                  <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="members-tab" data-toggle="tab" href="#members" role="tab" aria-controls="members" aria-selected="false">Member Info</a>
                    <a class="nav-item nav-link" id="client-info-tab" data-toggle="tab" href="#client-info" role="tab" aria-controls="client-info" aria-selected="true">Personal Details</a>
                    <a class="nav-item nav-link" id="invoices-tab" data-toggle="tab" href="#invoices" role="tab" aria-controls="invoices" aria-selected="true">Invoices</a>

                  </div>
                </nav>
                <div class="card-body">
                  <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                    {{-- Invoices info-tab --}}
                    <div class="tab-pane fade" id="invoices" role="tabpanel" aria-labelledby="invoices-tab">
                        <div class="row mt-4">
                            <div class="col-md-12">
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
                                            @foreach($member->Profile->Invoices as $invoice)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td><a target="_blank" href="{{ route('invoices.show',$invoice) }}">{{$invoice->ref_code }}</a></td>
                                                    <td>{{ $invoice->currency }}{{ number_format($invoice->amount_due,2) }}</td>
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
                        </div>
                    </div>

                    {{-- Contact tab --}}
                    <div class="tab-pane fade show active" id="members" role="tabpanel" aria-labelledby="members-tab">
                        <div class="row mt-4">
                          <div class="col-md-12">
                            <span></span>
                            <table class="table table-bordered mt-2">
                                <tr>
                                    <td width="50%"><strong>Offer No:</strong> {{ $member->entry_number }}</td>
                                    <td width="50%"><b>Status: </b>{{ $member->status }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Term Admitted:</strong>  {{ $member->effective_term }}</td>
                                    <td><strong>Admitted Class :</strong> {{ $member->Level->label }} ({{ $member->Stream->label }}) </td>
                                </tr>
                                <tr>
                                    <td><strong>Date Submitted:</strong> {{ $member->date_submitted }}</td>
                                    <td><strong>Offer Date:</strong> {{ $member->offer_date }}</td>
                                </tr>
                                <tr>
                                    <td><b>Client Feedback Date:</b> {{ $member->feedback_date }} </td>
                                    <td><strong>Feedback Deadline:</strong>{{ $member->deadline }}</td>

                                </tr>
                            </table>
                          </div>
                        </div>
                    </div>


                      <div class="tab-pane fade" id="client-info" role="tabpanel" aria-labelledby="client-info-tab">
                        <div class="row mt-3 pl-3 pr-3">
                            <div class="col-md-8">
                                <span class="strong">Client Information</span>
                            </div>

                            <div class="col-md-10 p-r-10">
                                <table class="table table-bordered">
                                    <tr>
                                        <td><strong>Gender:</strong>
                                            {{ $member->Profile->gender }}</td>
                                        <td><strong>Date Of Birth: </strong> {{ $member->Profile->birthday }} ({{ $member->Profile->age }} Yrs Old) </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Primary Lang.: </strong>{{ $member->Profile->primary_language}} </td>
                                        <td><strong>Religion: </strong>{{ $member->Profile->religion}} </td>
                                    </tr>
                                    <tr>
                                        <td><strong>State of Origin:</strong> {{ $member->Profile->StateOfOrigin->state_name }}</td>
                                        <td><strong>Nationality:</strong> {{ $member->Profile->nationality }}</td>
                                    </tr>
                                </table>
                            </div>


                        </div>

                        <div class="row mt-3 pl-3 pr-3">
                            <div class="col-md-8">
                                <span class="strong">Vitals</span>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-10 p-r-10">
                                @if (!empty($member->Profile->Vital))
                                <table class="table table-bordered">

                                    <tr>
                                        <td><strong>Blood Group:</strong> {{ $member->Profile->Vital->blood_group }}</td>
                                        <td><strong>Genotype: </strong> {{ $member->Profile->Vital->genotype }} </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Height:</strong> {{ $member->Profile->Vital->height }}ft</td>
                                        <td><strong>Weight:</strong> {{ $member->Profile->Vital->weight }}kg</td>
                                    </tr>

                                    <tr>
                                        <td><strong>Complexion: </strong>{{ $member->Profile->Vital->complexion}} </td>
                                        <td><strong>Tribal marks: </strong>
                                            @if ($member->Profile->Vital->tribal_marks == true)
                                                Yes
                                            @else
                                                No
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Eye Colour:</strong> {{ $member->Profile->Vital->eye_colour }}</td>
                                        <td><strong>Hair Colour:</strong> {{ $member->Profile->Vital->hair_colour }}</td>
                                    </tr>
                                </table>
                                @else
                                   <p class="text-danger">No vitals entered yet</p>
                                @endif
                            </div>


                        </div>

                        <hr>
                        <div class="row mt-3 pl-3 pr-3">


                            <div class="col-md-12">
                                <span class="strong">Agent Contacts</span>
                                <p> <b>Contact Name:</b> {{ $member->Agent->name }}</p>
                                <p> <b> Telephone: </b> {{ $member->Agent->telephone ?? 'None'}} </p>
                                <p> <b> Email: </b> {{ $member->Agent->Profile->email ?? 'None'}} </p>
                                <p> <b>Address: </b> @foreach($member->Profile->Addresses  as $address)
                                    {{  $address->full_address}}
                                    @endforeach
                                </p>
                            </div>
                        </div>

                      </div>

                  </div>
                </div>
              </div>
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
