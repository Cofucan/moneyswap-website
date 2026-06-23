
@extends('layouts.admin')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('css/realtytrack-form.css') }}">
@endpush
@section('content') 
<div class="container">
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-muted">Information</span>
              <span class="badge badge-secondary badge-pill">3</span>
            </h4>       
    </div>
    <div class="col-md-8 order-md-1"> 
      <h4 class="mb-3">Edit Levy</h4>
      <form action="{{ url('levies') }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" id="CreateLevy">
          {{csrf_field()}}
       
            <div class="form-group has-feedback">
              <label class="control-label" for="levy_name">Levy Name &nbsp;<span class="requiredfield">*</span></label>
              <input type="text" class="form-control"  value="{{old('lavy_name') }}" id="levy_name" name="levy_name" placeholder="" required>
                                        
                @if ($errors->has('levy_name '))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('levy_name ') }}</strong>
                  </span>
                @endif
            </div>
                         
          <div class="form-row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <label class="control-label" for="leviable_type">Leviable Type</label>
              <select name="leviable_type" value="{{old('leviable_type') }}"  class="custom-select d-block w-100" id="leviable_type" required>
                  <option value="">Choose...</option>
                  <option>California</option>
                </select>
                @if ($errors->has('leviable_type'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('leviable_type') }}</strong>
                          </span>
                        @endif
                                      
            </div>

            <div class="col-md-6 col-sm-6 col-xs-6 form-group has-feedback">
              <label class="control-label" for="amount">Amount &nbsp;<span class="requiredfield">*</span></label>
              <div class="input-group mb-2">
                <input type="text" class="form-control"  value="{{old('amount') }}" id="amount" name="amount" placeholder="" required>
                <div class="input-group-prepend">
                  <div class="input-group-text">NGN</div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <label class="control-label" for="billing_cycle">Payment Frequency</label>
              <select name="billing_cycle"  value="{{old('billing_cycle') }}" class="custom-select d-block w-100" id="billing_cycle" required>
                  <option value="">Monthly</option>
                  <option>Weekly</option>
                  <option>Quaterly</option>
                  <option>Yearly</option>
                </select>
                @if ($errors->has('billing_cycle'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('billing_cycle') }}</strong>
                          </span>
                        @endif
                                        
            </div>

            <div class="col-md-6 col-sm-6 col-xs-6 ">
               <br>
               <br>
              <div class="form-check">
                <input class="form-check-input custom-checkbox-control" type="checkbox" id="autoSizingCheck2">
                <label class="form-check-label" for="autoSizingCheck2">
                  Allow Partial Payment
                </label>
              </div>
              
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label class="control-label" for="day_due">Day Due &nbsp;<span class="requiredfield">*</span></label>
              <input type="date" class="form-control" value="{{old('day_due') }}" name="day_due" id="day_due"> 
              @if ($errors->has('grace_threshold '))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('grace_threshold') }}</strong>
                  </span>
                @endif                  
            </div>

            <div class="col-md-6 col-sm-6 col-xs-6 form-group has-feedback">
              <label class="control-label" for="grace_threshold">Grace Threshold </label>
              <div class="input-group mb-2">
                <input type="text" class="form-control" value="{{old('grace_threshold') }}" id="grace_threshold" name="grace_threshold" placeholder="" required>
                <div class="input-group-prepend">
                  <div class="input-group-text">DAYS</div>
                </div>    
              </div>                     
                @if ($errors->has('grace_threshold '))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('grace_threshold') }}</strong>
                  </span>
                @endif              
            </div>
          </div>
          <hr>
          <div class="form-row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <label class="control-label" for="status">Status</label>
              <select name="status" class="custom-select d-block w-100" id="status" required value="{{old('status') }}">
                  <option value="">Pending</option>
                  <option>Publish</option>
                  <option>Draft</option>
                </select>                                        
            </div>
              
            
          </div>

        <hr>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              
              
              <button type="submit" class="btn btn-success">Save and close</button>
              <button class="btn btn-primary" type="reset">Cancel</button>
            
            </div>
          </div>

      </form>
    </div>  
  </div>             
</div>
</div> 

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection
@push('scripts')
<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<!-- <script>
      $(document).ready(function(){
          $('#levy_name').select2();
       });
    </script> -->

@endpush