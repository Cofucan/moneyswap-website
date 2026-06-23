@if(!is_null($contact->organization_id))
<div class="form-group row mb-3">
  <label for="legal_name" class="control-label col-md-3">Company Name</label>
  <div class="col-md-8">
    <input type="text" name="legal_name" value="{{ $contact->company_name }}" class="form-control{{ $errors->has('legal_name') ? ' is-invalid' : '' }}"   id="" readonly/>
    @if ($errors->has('legal_name'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('legal_name') }}</strong>
        </span>
    @endif
  </div>
</div>
@endif
  <div class="form-group row mb-3">
    <label for="amount" class="control-label col-md-3">Contact Person</label>
    <div class="col-md-4"> 
      <input type="text" name="first_name" value="{{$contact->first_name  }}" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"   id="amount" Placeholder="First Name" readonly/>
    
        @if ($errors->has('amount'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('amount') }}</strong>
          </span>
        @endif
    </div>
    <div class="col-md-4"> 
      <input type="text" name="last_name" value="{{$contact->last_name }}" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"   id="amount" Placeholder="Last Name" readonly/>
    
        @if ($errors->has('amount'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('amount') }}</strong>
          </span>
        @endif
    </div>
  </div>

  <div class="form-group row mb-3">
    <label for="email" class="control-label col-md-3">Email </label>
    <div class="col-md-8">
      <input type="email" name="email" value="{{ $contact->email ?? '' }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"   id="email" required/>
      @if ($errors->has('email'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('email') }}</strong>
          </span>
      @endif
    </div>
  </div>

  <div class="form-group row mb-3">
    <label for="telephone" class="control-label col-md-3">Telephone </label>
    <div class="col-md-8">
        <input type="telephone" name="telephone" value="{{ $contact->telephone ?? ''}}" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}"   id="telephone" required/>
        @if ($errors->has('telephone'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('telephone') }}</strong>
            </span>
        @endif
    </div>
  </div>