@extends('layouts.admin')
@section('page_title', 'Create Payment Plan')

@push('styles')

<!-- custom style -->
<link rel="stylesheet" href="{{ asset('css/realtytrack-form.css') }}">
@endpush
@section('content')

<div class="row">
  <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>



        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Investment Plans</h4>
          <form action="{{ url('investmentplans.store') }}" method="POST"  id="CreatePaymentPlan" novalidate>
            {{csrf_field()}}
            <div class="form-group">
              <label for="package_id">Package</label>
                <select class="custom-select d-block w-100 select2" name="package_id" id="package" required>
                @foreach($packages as $key => $package)
                    @if(old('package_id') == $key)
                      <option value="{{$key}}" selected> {{$package}}</option>
                    @else
                    <option value="{{$key}}"> {{ $package}}</option>
                    @endif
                @endforeach
                </select>
                @if ($errors->has('package_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('package_id') }}</strong>
                </span>
                @endif
            </div>

            @include('investmentplans._form')

            <hr class="mb-4">
            <button class="btn btn-success" type="submit">Save </button>
            <button class="btn btn-primary" type="reset">Cancel</button>

          </form>
        </div>
</div>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\PaymentPlanRequest', '#CreatePaymentPlan'); !!}

@endsection
@push('scripts')
<script>
    CKEDITOR.replace( 'overview' );
</script>

@endpush
