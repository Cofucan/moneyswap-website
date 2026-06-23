@extends('layouts.admin')
@section('page_title', 'Edit Payment Plan')

@push('styles')


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
          <h4 class="mb-3">Inventory Payment Plans</h4>
          <form action="{{ route('paymentplans.update', $paymentplan->id) }}" method="POST"  id="UpdatePaymentPlan">
            {{csrf_field()}}
            @method('PUT')
            <div class="form-group">
              <label for="realty_inventory_id">Realty Inventory</label>
               
            </div>

            <div class="form-row">
              <div class="col-md-6 form-group mb-3">
                <label for="payment_tenure">Payment Tenure </label>
                <div class="input-group">
                  <input type="text" name="payment_tenure" value="{{ $paymentplan->payment_tenure }}" class="form-control{{ $errors->has('payment_tenure') ? ' is-invalid' : '' }}" id="payment_tenure">
                  <div class="input-group-append">
                     <span class="input-group-text">Month</span>
                  </div>
                </div>
                @if ($errors->has('payment_tenure'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('payment_tenure') }}</strong>
                  </span>
                @endif
              </div>

               <div class="col-md-6 mb-3">
                <label for="amount_due">Payment Frequency</label>
                <select name="billing_cycle" class="custom-select d-block w-100 select2" id="billing_cycle" required>
                    @foreach($paymentFrequencies as $key => $billing_cycle)
                    @if( $paymentplan->billing_cycle == $key)
                        <option value="{{$key}}" selected> {{$billing_cycle}}</option>
                    @else
                        <option value="{{$key}}"> {{$billing_cycle}}</option>
                    @endif
                  @endforeach
                </select>
                @if ($errors->has('billing_cycle'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('billing_cycle') }}</strong>
                          </span>
                        @endif
              </div>
          
            </div>


            <div class="form-row">
               <div class="from-group col-md-6 mb-3">
                <label for="initial_deposit">Initial Deposit </label>
                <div class="input-group">
                   <div class="input-group-append">
                     <span class="input-group-text">NGN</span>
                  </div>
                  <input type="text" name="initial_deposit" value="{{ $paymentplan->initial_deposit }}" class="form-control{{ $errors->has('initial_deposit') ? ' is-invalid' : '' }}" id="initial_deposit" placeholder="First payment due" required>
                </div>
                @if ($errors->has('initial_deposit'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('initial_deposit') }}</strong>
                    </span>
                  @endif
              </div>

              <div class="col-md-6 form-group mb-3">
                <label for="instalment_amount">Instalment Amount</label>
                <div class="input-group">
                   <div class="input-group-append">
                     <span class="input-group-text">NGN</span>
                  </div>
                  <input type="text" name="instalment_amount" value="{{ $paymentplan->instalment_amount }}" class="form-control{{ $errors->has('instalment_amount') ? ' is-invalid' : '' }}" id="instalment_amount" placeholder="Reccurent amount payable">
                </div>
                @if ($errors->has('instalment_amount'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('instalment_amount') }}</strong>
                          </span>
                        @endif
              </div>
            </div>

            <div class="mb-3">
              <label for="overview">Payment Plan Remarks <span class="text-muted">(Optional)</span></label>
              <textarea name="overview" class="form-control{{ $errors->has('overview') ? ' is-invalid' : '' }}" id="overview" placeholder="Remarks">
             {!! $paymentplan->overview !!}
            </textarea>
                @if ($errors->has('overview'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('overview') }}</strong>
                          </span>
                        @endif
            </div>



            <hr class="mb-4">
            <button class="btn btn-success" type="submit">Update </button>

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
