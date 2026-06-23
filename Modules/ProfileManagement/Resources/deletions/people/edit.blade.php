@extends('layouts.admin')
@section('page_title', $person->name)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/jobs.css') }}">

<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<!--<link rel="stylesheet" href="{{ asset ('css/resume.css') }}">-->

@endpush
@section('content')

<section class="education">
  <div class="container">
    
    <div class="row">

      <div class="col-md-8  order-md-1">
        {{-- @include('partials.alert') --}}
        <div class="card">
          <div class="card-header">
            <h4 class="mb-3">Personal Information </h4>
            <small> Tell us more about yourself</small>
          </div>
          <div class="form-card">
            <form action="{{ route('people.update', $person->id) }}" method="POST"  id="UpdatePerson" enctype="multipart/form-data">
              {{csrf_field()}}
              @method('PUT')
            
              <div class="form-row mb-3">
                <div class="form-group col-md-5">
                    <label for="last_name" class="control-label">Last Name</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <select id="salutation" name="salutation" class="custom-select select2 w-100 form-control" data-live-search="true" title="Please select a salutation ...">
                            @foreach($salutations as $key => $salutation)  
                            @if($person->salutation == $key)
                              <option value="{{$key}}" selected> {{$salutation}}</option>
                              @else
                                <option value="{{$key}}"> {{$salutation}}</option>
                              @endif
                           
                            @endforeach
                        </select>
                      </div>
                      <input type="text" name="last_name" value="{{ $person->last_name }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" placeholder=""required>
                    </div>
                    @if ($errors->has('last_name'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group col-md-4">
                  <label for="first_name" class="control-label">First Name</label>
                  <input type="text" name="first_name" value="{{ $person->first_name }}" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" placeholder="">

                    @if ($errors->has('first_name'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('first_name') }}</strong>
                      </span>
                    @endif
                </div>

                <div class="form-group col-md-3 ">
                  <label for="middle_name" class="control-label">Middle Name</label>
                  <input type="text" name="middle_name" value="{{ $person->middle_name }}" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" id="middle_name" placeholder="">

                    @if ($errors->has('middle_name'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('middle_name') }}</strong>
                      </span>
                    @endif
                </div>
              </div>

              <div class="form-row mb-3">
                <div class="form-group col-md-6">
                      <label class="control-label" for="birthday">Date of Birth</label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                          <input type="text" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }} pull-right" name="birthday"  value="{{ $person->birthday }}">
                      </div>

                      @if ($errors->has('birthday'))
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('birthday') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group col-md-6">
                    <label class="control-label" for="primary_language">Primary Language</label><br>
                    <input type="text" name="primary_language" value="{{ $person->primary_language }}" class="form-control{{ $errors->has('religion') ? ' is-invalid' : '' }}" id="religion" >

                    @if ($errors->has('primary_language'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('primary_language') }}</strong>
                      </span>
                    @endif
                  </div>
              </div>

       
            <div class="form-row mb-3">
              <div class="form-group col-md-6">
                <label for="gender" class="control-label"> Gender </label><br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input id="Male" name="gender" type="radio" value="Male" class="custom-control-input" {{ $person->gender =='Male' ? 'checked' : ''}} required>
                    <label class="custom-control-label" for="Male">Male</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input id="Female" name="gender" type="radio" value="Female" class="custom-control-input" {{ $person->gender =='Female' ? 'checked' : ''}} required>
                    <label class="custom-control-label" for="Female">Female</label>
                </div>
                @if ($errors->has('gender'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                @endif

              </div>

              <div class="form-group col-md-6">
                <label class="control-label" for="marital_status">Marital Status</label><br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input id="single" name="marital_status" type="radio" value="single" class="custom-control-input" {{ $person->marital_status == 'single' ? 'checked' : ''}}>
                    <label class="custom-control-label" for="single">Single</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input id="married" name="marital_status" type="radio" value="married" class="custom-control-input" {{ $person->marital_status == 'married' ? 'checked' : ''}} >
                    <label class="custom-control-label" for="married">Married</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input id="divorced" name="marital_status" type="radio" value="divorced" class="custom-control-input" {{ $person->marital_status == 'divorced' ? 'checked' : ''}} >
                    <label class="custom-control-label" for="divorced">Divorced</label>
                </div>
                @if ($errors->has('marital_status'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('marital_status') }}</strong>
                    </span>
                @endif
              </div>  
            </div>           

              <hr class="mb-4">
              <button class="btn btn-primary" type="submit">Save </button>
              <button class="btn btn-success" type="submit" name="todo" value="Continue">Save & Continue</button>

          </form>
          </div>
        </div>
      </div>
      
  </div>
</div>
</section>

@endsection
@push('scripts')

<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
     <script>
        jQuery(document).ready(function($) {

        $('.select2').select2();

        CKEDITOR.replace( 'bio' );
        });
    </script>

       <script src="{{ asset ('plugins/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
        jQuery(document).ready(function($) {

            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                locale: {
                format: 'YYYY-MM-DD'
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


@endpush
