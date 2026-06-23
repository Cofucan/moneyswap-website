@extends('layouts.admin')
@section('page_title',  Auth::user()->full_name)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/client.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush
@section('content')



    <div class="container ">
     <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
      <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
      </a>

      <span class="s-text16">
       Client Profile
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
      </span>


    </div>
     <div class="row ">
        <div class="col-md-6 content_title">
            <h4>  Client Info </h4>
            {{--  <span> <strong class="p-r-50">Referral Code: </strong>{{ $profile->User->referral_code }}</span>  --}}
        </div>
        <div class="col-md-6">

          <div class="page_button text-right">
            <a class="btn btn-sm btn-warning" href=""><i class="fa fa-user-info"></i> View Report</a>
            <a class="btn btn-sm btn-primary" href=""><i class="fa fa-file-o"></i> Assessments</a>
            <a class="btn btn-sm btn-danger" href=""><i class="fa fa-money"></i> Add Fee</a>
          </div>
        </div>
      </div>

    <div class="row mt-4 mb-5">
  		<div class="col-sm-4"><!--left col-->
            <form action="" method="POST" enctype="multipart/form-data" >
            {{--  <form action="{{ route('profiles.changedisplay') }}" method="POST" enctype="multipart/form-data" >  --}}
            {{csrf_field()}}
            <input type="hidden" name="variation_id" value="">
            <div class="input-group mb-3">
                <img src="{{ asset ('img/icons/avatar.png') }}" alt="Profile Picture" class="avatar img-circle img-thumbnail" height="100px">
                <input type="file" name="display_image" class="form-control center-block file-upload {{ $errors->has('display_image') ? ' is-invalid' : '' }}" required>
                <div class="input-group-append" id="button-addon4">
                <button type="submit" class="btn btn-sm btn-primary btn-block">
                    {{ __('Change') }}
                </button>
                </div>
            </div>
        </form>


      <hr>



        </div><!--/col-3-->
    	<div class="col-sm-6">

         <h4 class="mt-4">  {{ Auth::user()->full_name }} </h4>
          <ul class="no-bullet mt-4">
            <li><strong>Admission No.:</strong> <span class="pull-right">SVIC025</span></li>
            <li><strong>Level:</strong> <span class="pull-right">J.S.S1</span></li>
            <li><strong>Room:</strong><span class="pull-right">JSS1A</span></li>
            <li><strong>Roll No:</strong><span class="pull-right">0254</span></li>
            <li><strong>Primary Language:</strong><span class="pull-right">Hausa</span></li>
            <li><strong>Account Id</strong><span class="pull-right">056780</span></li>
            <li><strong>Expd. Graduation Date:</strong><span class="pull-right">September 24th 2022</span></li>
          </ul>




        </div><!--/col-9-->

        <div class="col-md-12" id="tab">



                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-description" role="tab" aria-controls="nav-description" aria-selected="true">Enrolment Info</a>
                            <a class="nav-item nav-link" id="nav-features-tab" data-toggle="tab" href="#nav-features" role="tab" aria-controls="nav-features" aria-selected="false">Client Info</a>
                            <a class="nav-item nav-link" id="nav-titles-tab" data-toggle="tab" href="#nav-titles" role="tab" aria-controls="nav-titles" aria-selected="false">Academics Info</a>
                            <a class="nav-item nav-link" id="nav-gallery-tab" data-toggle="tab" href="#nav-gallery" role="tab" aria-controls="nav-gallery" aria-selected="false">ScoringSchemes</a>

                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                         <ul class="list-stream p-t-20">
                                <li class="list-stream-item text-muted"><strong>Enrolment Information </strong></li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Set Name</strong></span>{{ Auth::user()->full_name }}</li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Academic Term</strong></span> </li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Enrollment Type</strong></span>  </li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Enrollment Date</strong></span>  </li>

                            </ul>
                        </div>
                        <div class="tab-pane fade" id="nav-features" role="tabpanel" aria-labelledby="nav-features-tab">

                            <ul class="list-stream p-t-20">
                                <li class="list-stream-item text-muted"><strong>Personal Info </strong></li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Full Name</strong></span>{{ Auth::user()->full_name }}</li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Address</strong></span> </li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Email</strong></span> </li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Telephone</strong></span>  </li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Gender</strong></span> {{ Auth::user()->Person->gender }} </li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Birthday</strong></span> {{ Auth::user()->Person->birthday }} </li>

                            </ul>
                        </div>
                        <div class="tab-pane fade" id="nav-gallery" role="tabpanel" aria-labelledby="nav-gallery-tab">
                            <ul class="list-stream p-t-20">
                                <li class="list-stream-item text-muted"><strong>SubjectCategory Offerred </strong></li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Full Name</strong></span>{{ Auth::user()->full_name }}</li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="nav-titles" role="tabpanel" aria-labelledby="nav-titles-tab">
                            <ul class="list-stream p-t-20">
                                <li class="list-stream-item text-muted"><strong>Additional Information </strong></li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Full Name</strong></span>{{ Auth::user()->full_name }}</li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Profile type</strong></span> }</li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Address</strong></span> </li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Email</strong></span> </li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Telephone</strong></span>  </li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Gender</strong></span> {{ Auth::user()->Person->gender }} </li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Birthday</strong></span> {{ Auth::user()->Person->birthday }} </li>
                                <li class="list-stream-item text-right"><span class="pull-left"><strong>Joined Since</strong></span>  </li>

                            </ul>
                        </div>

                    </div>


        </div>

    </div>





@endsection

@push('scripts')
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

 @endpush
