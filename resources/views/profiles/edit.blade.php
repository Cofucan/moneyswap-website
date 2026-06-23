@extends('layouts.admin')
@section('page_title', $profile->full_name)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

<section class="education">
  <div class="container">

    <div class="row">

      <div class="col-md-8  order-md-1">
        <div class="card">
          <div class="card-header">
            <h4 class="mb-3">Personal Information </h4>
            <small> Tell us more about yourself</small>
          </div>
          <div class="form-card">
          <form action="{{ route('profiles.update', $profile->referral_code) }}" method="POST"  id="UpdateProfile" enctype="multipart/form-data">
            {{csrf_field()}}
            @method('PUT')

              <input type="hidden" name="country_id" value="{{ $profile->country_id }}">

              <div class="form-row mb-3">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="last_name" class="control-label">Last Name</label>
                    <input type="text" name="last_name" value="{{ $profile->last_name }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" placeholder=""required>
                    @if ($errors->has('last_name'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="first_name" class="control-label">First Name</label>
                    <input type="text" name="first_name" value="{{ $profile->first_name }}" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" placeholder="">

                    @if ($errors->has('first_name'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('first_name') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="middle_name" class="control-label">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ $profile->middle_name }}" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" id="middle_name" placeholder="">

                    @if ($errors->has('middle_name'))
                      <span class="invalid-feedback">
                      <strong>{{ $errors->first('middle_name') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="form-row mb-3">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" for="birthday">Date of Birth</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                      <input type="date" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }} pull-right" name="birthday"  value="{{ $profile->birthday }}">
                    </div>

                     @if ($errors->has('birthday'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('birthday') }}</strong>
                        </span>
                      @endif
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="gender" class="control-label"> Gender </label><br>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input id="Male" name="gender" type="radio" value="Male" class="custom-control-input" {{ $profile->gender =='Male' ? 'checked' : ''}} required>
                      <label class="custom-control-label" for="Male">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input id="Female" name="gender" type="radio" value="Female" class="custom-control-input" {{ $profile->gender =='Female' ? 'checked' : ''}} required>
                      <label class="custom-control-label" for="Female">Female</label>
                    </div>
                    @if ($errors->has('gender'))
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('gender') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              </div>
              @if ($profile->Addresses->count() < 1)
                <h6 class="m-l-20">Your Address</h6>
                  @include('addresses._form')
              @endif
              <hr class="mb-4">
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
