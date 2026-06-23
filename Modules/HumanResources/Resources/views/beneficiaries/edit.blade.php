@extends('layouts.admin')
@section('page_title', 'Edit Donor')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
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
  #group_loading{
      visibility:hidden;
      }
</style>
@endpush
@section('content')

<div class="container-fluid">

  <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
          <i class="fa fa-home"></i> Dashboard
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('donors/manage')}}" class="s-text16">
          Members
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
          Edit Donor
        </span>
    </div>
  <div class="row">
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Edit Donor </h4>
          <form method="POST" action="{{ route('donors.update', $donor->id) }}" id="CreateEvent" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
                <input type="hidden" name="person_id" id="person_id" value="{{$donor->person_id}}">
                <input type="hidden" name="profile_id" id="person_id" value="{{$donor->profile_id}}">

                <div class="form-group">
                  <strong> Donor Name: </strong> {{$donor->Person->candidate_name}}
                </div>


                <div class="form-row">
                  <div class="col-md-6 col-sm-6 mb-3 form-goup">
                    <label for="section">Level Level</label>
                    <div class="input-group">
                      <select name="section_id" class="custom-select" id="section" required>
                        <option>Choose Section </option>
                        @foreach($sections as $key => $section)
                        <option value="{{$key}}"> {{$section}}</option>
                        @endforeach
                      </select>
                      <div class="input-group-append">
                      <select name="level_id" class="custom-select select2" id="level" required>
                      </select>

                        @if ($errors->has('level_id'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('level_id') }}</strong>
                          </span>
                        @endif

                      </div>

                    </div>
                    @if ($errors->has('section_id'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('section_id') }}</strong>
                                </span>
                    @endif
                  </div>

                  <div class="col-md-6 col-sm-6 mb-3 form-group">
                    <label for="group_id"> Academic Group </label>
                    <select id="group" class="select2 form-control" name="group_id" data-live-search="true" >
                    </select>
                    <span id="group_loading"><i class="fa fa-spinner fa-spin"></i></span>
                    @if ($errors->has('group_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('group_id') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="form-row mb-3">
                  <div class="col-md-6 col-sm-6 form-group">
                    <label for="status"> Enrolment Status </label>
                    <select id="status" class="select2 form-control" name="enrolment_status" data-live-search="true" >
                        @foreach($enrolmentStatuses as $key => $enrolemtStatus)
                        <option value="{{$key}}"> {{$enrolemtStatus}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="col-md-6 col-sm-6 mb-3 form-group">
                      <label for="client_category_id"> Donor Type </label>
                      <select name="client_category_id" class="custom-select d-block w-100 select2" id="student_type" required>
                          @foreach($clientcategories as $key => $student_type)
                              <option value="{{$key}}"> {{$student_type}}</option>

                          @endforeach
                      </select>
                      @if ($errors->has('client_category_id'))
                                  <span class="invalid-feedback">
                                  <strong>{{ $errors->first('client_category_id') }}</strong>
                                  </span>
                      @endif
                  </div>
                </div>

                {{-- <div class="form-group">
                    <label for="graduation_year">End Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <input type="text" name="graduation_year" value="{{old ('graduation_year')}}" class="form-control{{ $errors->has('graduation_year') ? ' is-invalid' : '' }}"  id="graduation_year" />
                    </div>
                    @if ($errors->has('graduation_year'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('graduation_year') }}</strong>
                        </span>
                    @endif

                </div> --}}
                <div class="form-group ">
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" class="form-control" placeholder="Enter remarks">
                    {{!! $donor->remarks !!}}
                    </textarea>
                    @if ($errors->has('remarks'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('remarks') }}</strong>
                        </span>
                    @endif
                </div>


                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>

            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')
  <script src="{{ asset('js/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    $('#section').on('change',function(){
      var section = $(this).val();
      if(section){
        $.ajax({
          type:"GET",
          url:"{{url('sections/get-levels')}}?section="+section,
          beforeSend: function()
          {
            $('#live_loading').css("visibility", "visible");
          },
          success:function(res){
            if(res){

              $("#level").empty();

              $('#live_loading').css("visibility", "hidden");
              $('#requirement_title').css("visibility", "visible");
              $.each(res,function(key,value)
              {
                $("#level").append('<option value="'+key+'">'+value+'</option>'); });
              }else
              {
                $("#level").empty();
              }
            } });
      }else{
        $("#level").empty();
      }
    });

    $('#section').on('change',function()  {
      var section = $(this).val();
      if(section){
        $.ajax({
          type:"GET",
          url:"{{url('sections/get-groups')}}?section="+section,
          beforeSend: function()
          {
            $('#group_loading').css("visibility", "visible");
          },
          success:function(res){
            if(res){
              $("#group").empty();
              $('#group_loading').css("visibility", "hidden");
              $.each(res,function(key,value)
              {
                $("#group").append('<option value="'+key+'">'+value+'</option>'); });
              }else
              {
                $("#group").empty();
              }
            } });
        }else{
          $("#group").empty();
        }
    });
  </script>
    <script>
      CKEDITOR.replace("remarks",
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
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script>
      jQuery(document).ready(function($) {
          $('input[name="graduation_year"]').daterangepicker({
              singleDatePicker: true,
              timePicker: true,
              locale: {
              format: 'YYYY/M/DD'
              }
          });
      });
  </script>

@endpush
