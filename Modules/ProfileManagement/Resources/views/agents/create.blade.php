
@extends('layouts.admin')
@section('page_title', 'Add Agent')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
@endpush
@section('content')

  <nav aria-label ="breadcrumb mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"> <a href="{{ url('agents/manage') }}">Agents</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Add New</li>
    </ol>
  </nav>
  <div class="row">

    <div class="col-md-8 order-md-1">
      <h4 class="mt-3">Agent Enrolment Form</h4>
      <h5 class="mt-3">Use the form below to add a new Agent <br>
      <small>All fields marked (<span class="text-danger">*</span>) are compulsory</small>
      </h5>
      <hr>
      <form action="{{ route('agents.store') }}" method="POST" enctype="multipart/form-data" id="CreateMerchant">
        {{csrf_field()}}
         <input type="hidden" value="5" id="role_id" name="role_id">
         <div class="form-row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label" for="first Name"> Contact Person <span class="text-danger">*</span> </label>
              <div class="input-group">
                <div class="input-group-append">
                  <select class="select2 form-control" name="salutation">
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Miss">Miss</option>
                  </select>
                </div>
                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" placeholder="Last Name" required >
              </div>
              @if ($errors->has('last_name'))
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('last_name') }}</strong>
                  </span>
              @endif
              </div>
            </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label" for="first"> <br> </label>
              <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" placeholder="First Name">
              @if ($errors->has('first_name'))
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('first_name') }}</strong>
                  </span>
              @endif
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="telephone" class="label-control">Telephone <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"> <i class="fa fa-phone"></i></div>
                </div>
                <input id="telephone" type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" placeholder="" value="{{ old('telephone') }}" required>
              </div>
              @if ($errors->has('telephone'))
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('telephone') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="email" class="label-control"> Email</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"> <i class="fa fa-envelope"></i></div>
                </div>
                <input id="email" type="email" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="">
              </div>

              @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label" for="occupation">Occupation</label>
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

@include('locationmanagement::addresses._locality')

                <div class="from-group">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="setup" id="setup" value="1">
                      <label class="form-check-label" for="setup"> Invite this parent to enter own details online </label>
                    </div>
                  </div>
        <hr>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">

              <button type="submit" class="btn btn-success">Save and close</button>
              <button class="btn btn-primary" type="submit" name="todo" value="Continue">Save & Add New</button>

            </div>
          </div>

      </form>
    </div>
  </div>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection
@push('scripts')
<!-- Select2 -->
<script>
    CKEDITOR.replace( 'about_organization' );
</script>


@endpush
