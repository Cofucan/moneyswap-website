<div class="form-row">
    <div class="col-md-6 form-group">
        <label for="designation_id">Designation</label>
        <select class="custom-select d-block w-100 select2{{ $errors->has('designation_id') ? ' is-invalid' : '' }}" name="designation_id">
            @foreach($designations as $key => $designation)
                @if(old('designation_id') == $key)
                <option value="{{$key}}" selected> {{$designation}}</option>
                @else
                <option value="{{$key}}"> {{$designation}}</option>
                @endif
            @endforeach
        </select>
        @if ($errors->has('designation_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('designation_id') }}</strong>
                </span>
        @endif
    </div>
    
    <div class="col-md-6 form-group">
        <label for="qualification">Qualification</label>
        <select class="custom-select d-block w-100 select2{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification">
            @foreach($qualifications as $key => $qualification)
                @if(old('qualification') == $key)
                <option value="{{$key}}" selected> {{$qualification}}</option>
                @else
                <option value="{{$key}}"> {{$qualification}}</option>
                @endif
            @endforeach
        </select>
        @if ($errors->has('qualification'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('qualification') }}</strong>
                </span>
        @endif
    </div>
</div> 

<div class="form-row">
    <div class="col-md-6 form-group">
        <label for="employment_type_id">Employee type</label>
        <select class="custom-select d-block w-100 select2{{ $errors->has('employment_type_id') ? ' is-invalid' : '' }}" name="employment_type_id">
            @foreach($employeeTypes as $key => $employeeType)
                @if(old('employment_type_id') == $key)
                <option value="{{$key}}" selected> {{$employeeType}}</option>
                @else
                <option value="{{$key}}"> {{$employeeType}}</option>
                @endif
            @endforeach
        </select>
        @if ($errors->has('employment_type_id'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('employment_type_id') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-6 form-group">
        <label for="employee_status">Employment Status</label>
        <select class="custom-select{{ $errors->has('employee_status') ? ' is-invalid' : '' }} d-block w-100 select2"  name="employee_status" id="employee_status" required>
        <option > Choose Status</option>
        @foreach($employeeStatus as $key => $status)
        @if(old('employee_status') == $key)
        <option value="{{$key}}" selected> {{$status}}</option>
            @else
            <option value="{{$key}}"> {{$status}}</option>
            @endif
        @endforeach

        </select>
        @if ($errors->has('employee_status'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('employee_status') }}</strong>
            </span>
        @endif
    </div>
</div>
     

   <div class="form-row"> 
        <div class="col-md-6 form-group">
            <label for="amount_due">Revenue Frequency</label>
            <select name="payment_frequency" class="custom-select d-block w-100 select2" id="payment_frequency" required>
                @foreach($paymentFrequencies as $key => $payment_frequency)
                @if( old('payment_frequency') == $key)
                    <option value="{{$key}}" selected> {{$payment_frequency}}</option>
                @else
                    <option value="{{$key}}"> {{$payment_frequency}}</option>
                @endif
            @endforeach
            </select>
            @if ($errors->has('payment_frequency'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('payment_frequency') }}</strong>
                    </span>
                    @endif
        </div>
        
        <div class="col-md-6 form-group">
            <label class="control-label" for="basic_pay">Basic Pay &nbsp;<span class="requiredfield">*</span></label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" value="{{old ('basic_pay')}} " id="basic_pay" name="basic_pay" required>
                <div class="input-group-prepend">
                    <select id="currency" name="currency" class="custom-select select2 w-100 form-control" data-live-search="true" title="Please select a currency ...">
                        <option value="NGN">NGN</option>
                    </select>
                </div>
                @if ($errors->has('basic_pay'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('basic_pay') }}</strong>
                    </span>
                @endif
            </div>
        </div>
   </div>

        
    
