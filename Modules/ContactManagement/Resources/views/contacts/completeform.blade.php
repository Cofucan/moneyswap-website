@push('styles')

<style>
    .myDiv{
        display:none;
    }
</style>
@endpush

  <div class="form-row mb-2">
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
  </div>

  @include('contactmanagement::contacts._form')
 

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