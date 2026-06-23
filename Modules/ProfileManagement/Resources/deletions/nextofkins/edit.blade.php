@extends('layouts.admin')
@section('pagetitle', 'Create Subscription')
@section('content_title', 'Add Payment Plan')
@section('subtitle', 'Please provide data for all required fields')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<!-- custom style -->
<link rel="stylesheet" href="{{ asset('css/realtytrack-form.css') }}">
@endpush
@section('content')
    <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Information</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>          
    </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Next of Kins</h4>
          <form action="{{ url('realtysubscriptions') }}" method="POST"  id="RealtySubscriptionForm" novalidate>
          {{csrf_field()}}
            <div class="row">
              <div class="col-md-6 mb-3">
              <label for="realtyinventory_id">Realty Scheme</label>
                <select class="custom-select d-block w-100" name="realtyinventory_id" value="{{old('realtyinventory_id') }}" id="realtyinventory_id" required>
                  <option value="">Choose...</option>
                  <option>United States</option>
                </select>
                @if ($errors->has('realtyinventory_id'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('realtyinventory_id') }}</strong>
                          </span>
                @endif
              </div>
              <div class="col-md-6 mb-3">
              <label for="payment_plan_id">Payment Options <span class="text-muted">(Months)</span></label>
                <select name="payment_plan_id" class="custom-select d-block w-100" id="payment_plan_id" required>
                  <option value="1">Outright Payment</option>
                  <option value="3">3-Months Payment</option>
                  <option value="6">Outright Payment</option>
                  <option value="12">Outright Payment</option>
                  <option value="18">Outright Payment</option>
                  <option value="24">Outright Payment</option>
                  <option value="36">Outright Payment</option>
                  
                </select>
                @if ($errors->has('payment_plan_id'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('payment_plan_id') }}</strong>
                          </span>
                        @endif
              </div>
            </div>
              

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="subscription_quantity">Quantity to subscribe</label>
                
                <input type="text" name="subscription_quantity" value="{{old('subscription_quantity') }}" class="form-control{{ $errors->has('subscription_quantity') ? ' is-invalid' : '' }}" id="subscription_quantity" placeholder="enter subscription_quantity">
                @if ($errors->has('subscription_quantity'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('subscription_quantity') }}</strong>
                          </span>
                        @endif
              </div>
              <div class="col-md-6 mb-3">
                <label for="required_deposit">Required Deposit</label>
                <input type="text" name="required_deposit" value="{{old('required_deposit') }}" class="form-control{{ $errors->has('required_deposit') ? ' is-invalid' : '' }}" id="required_deposit" placeholder="enter required_deposit">
                @if ($errors->has('required_deposit'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('required_deposit') }}</strong>
                          </span>
                        @endif
              </div>
            </div>

            <div class="mb-3">
              <label for="initial_payment">Initial Payment <span class="text-muted">(Optional)</span></label>
              <input type="text" name="initial_payment" value="{{old('initial_payment') }}" class="form-control{{ $errors->has('initial_payment') ? ' is-invalid' : '' }}" id="initial_payment" placeholder="First payment due">
              @if ($errors->has('initial_payment'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('initial_payment') }}</strong>
                          </span>
                        @endif
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="instalment_amount">Instalment Amount</label>
                
                <input type="text" name="instalment_amount" value="{{old('instalment_amount') }}" class="form-control{{ $errors->has('instalment_amount') ? ' is-invalid' : '' }}" id="instalment_amount" placeholder="reccurent amount payable">
                @if ($errors->has('instalment_amount'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('instalment_amount') }}</strong>
                          </span>
                        @endif
              </div>
              <div class="col-md-6 mb-3">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" class="custom-select d-block w-100" id="payment_method" required>
                  <option value="1">Outright Payment</option>
                  <option value="3">3-Months Payment</option>
                  <option value="6">Outright Payment</option>
                  <option value="12">Outright Payment</option>
                  <option value="18">Outright Payment</option>
                  <option value="24">Outright Payment</option>
                  <option value="36">Outright Payment</option>
                  
                </select>
                @if ($errors->has('payment_method'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('payment_method') }}</strong>
                          </span>
                        @endif
              </div>
            </div>
            <hr class="mb-4">

            <div class="mb-3">
              <label for="referral_phone">Referral Phone <span class="text-muted">(Optional)</span></label>
              <input type="text" name="referral_phone" value="{{old('referral_phone') }}" class="form-control{{ $errors->has('referral_phone') ? ' is-invalid' : '' }}" id="referral_phone" placeholder="Referrals Telephone No">
              @if ($errors->has('referral_phone'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('referral_phone') }}</strong>
                          </span>
                        @endif
            </div>

            <div class="mb-3">
              <label for="attestation">Attestation <span class="text-muted">(Optional)</span></label>
              <textarea name="attestation" class="form-control{{ $errors->has('attestation') ? ' is-invalid' : '' }}" id="attestation" placeholder="community description"> </textarea>
                @if ($errors->has('attestation'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('attestation') }}</strong>
                          </span>
                        @endif
            </div>

              

            <hr class="mb-4">
            <button class="btn btn-success" type="submit">Save </button>
            <button class="btn btn-primary" type="reset">Cancel</button>
            
          </form>
        </div>
@endsection
@push('scripts')
<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script>
      $(document).ready(function(){
          $('#payment_plan_id').select2();
       });
    </script>

@endpush