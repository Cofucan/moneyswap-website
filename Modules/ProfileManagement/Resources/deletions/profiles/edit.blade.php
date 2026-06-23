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
            <h4 class="mb-3">Personal Information Update</h4>
          </div>
          <div class="form-card">
            <form action="{{ route('profiles.update', $profile) }}" method="POST"  id="UpdateProfile" enctype="multipart/form-data">
              {{csrf_field()}}
              @method('PUT')
              @include('profilemanagement::profiles._formedit')
              @if($profile->role_id == 9)
               <div class="form-row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="occupation">What is your Occupation</label>
                        <input type="text" class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}" id="occupation" name="occupation" placeholder="" value="{{old('occupation') }}">
                        @if ($errors->has('occupation '))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('occupation ') }}</strong>
                        </span>
                        @endif
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="income" class="label-control">Annual Income</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">NGN</div>
                        </div>
                        <input type="text" value="{{old('income') }}" class="form-control{{ $errors->has('income') ? ' is-invalid' : '' }}" id="income" name="income" placeholder="Annual Income" value="{{old('occupation') }}">
                        </div>

                        @if ($errors->has('income'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('income') }}</strong>
                        </span>
                        @endif
                    </div>
                    </div>
                </div>
              @endif
              <hr class="mb-4">
              <button class="btn btn-success" type="submit" name="todo" value="Continue">Update </button>
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
