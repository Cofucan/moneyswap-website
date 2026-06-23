@push('styles')

<style>
    .myDiv{
        display:none;
    }
</style>
@endpush

  {{-- <div class="form-row mb-2">
    <div class="col-md-12 mb-3 form-group">
        <label for="contact_type" class="control-label mb-3">Contact Type</label><br>
        <div class="custom-control custom-radio custom-control-inline">
            <input id="individual" name="contact_type" type="radio" value="Individual" class="custom-control-input" required>
            <label class="custom-control-label" for="individual">Individual</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input id="Organization" name="contact_type" type="radio" value="Organization" class="custom-control-input" required>
            <label class="custom-control-label" for="Organization">Company</label>
        </div>                           
    </div>
    <div class="col-md-12">
        <div id="showIndividual" class="myDiv">         
        </div>
        <div id="showOrganization" class="myDiv">
          <div class="form-group row mb-3">
            <label for="legal_name" class="control-label col-md-3">Company Name</label>
            <div class="col-md-8">
              <input type="text" name="legal_name" value="" class="form-control{{ $errors->has('legal_name') ? ' is-invalid' : '' }}"   id="legal_name"/>
              @if ($errors->has('legal_name'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('legal_name') }}</strong>
                  </span>
              @endif
            </div>
          </div>
        </div>
    </div>
  </div> --}}
  <div class="form-group row mb-3">
    <label for="amount" class="control-label col-md-3">Contact Person</label>
    <div class="col-md-4"> 
      <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"   id="amount" Placeholder="First Name"/>
    
        @if ($errors->has('amount'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('amount') }}</strong>
          </span>
        @endif
    </div>
    <div class="col-md-4"> 
      <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"   id="amount" Placeholder="Last Name"/>
    
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
      <input type="email" name="email" value="{{  old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"   id="email" required/>
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
        <input type="telephone" name="telephone" value="{{ old('telephone') }}" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}"   id="telephone" required/>
        @if ($errors->has('telephone'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('telephone') }}</strong>
            </span>
        @endif
    </div>
  </div>

@push('scripts')
<script>
  jQuery(document).ready(function($){
      $('input[name="contact_type"]').click(function(){
      var demovalue = $(this).val();
      $("div.myDiv").hide();
      $("#show"+demovalue).show();
      });
  });
</script>

@endpush