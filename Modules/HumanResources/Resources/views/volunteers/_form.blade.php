@push('styles')
  <style>        
    #plan_loading{
        visibility:hidden;
    }
</style>

@endpush
  <div class="form-row mb-3">
    <div class="col-md-12">
      <label class="control-label" for="expertise">Volunteer Service</label>                              
          <select name="expertise_id" id="expertise" class="custom-select select2 w-100 form-control" data-live-search="true" >
            <option value ="">Choose Volunteer Services </option>
              @foreach ($expertises as $key=> $expertise)
              <option value="{{ $key}}"> {{ $expertise }}</option>
              @endforeach   
          </select>
    </div>  

      {{-- <div class="col-md-6 form-group">
        <label for="investment_plan_id"> Volunteer Duration</label>  <span id="plan_loading"><i class="fa fa-spinner fa-spin"></i></span>
        <select name="investment_plan_id" class="custom-select d-block w-100 select2" id="investmentplan">
            <option value ="">Choose Duration </option>
        </select>
        @if ($errors->has('investment_plan_id'))
          <span class="invalid-feedback">
            <strong>{{ $errors->first('investment_plan_id') }}</strong>
          </span>
        @endif
      </div>   --}}

     

  </div>

  
  {{-- <div class="form-row"> 
    <div class="col-md-6 form-group">
      <label for="payment_method" class="control-label">Payment Method</label> <br>
      <div class="custom-control custom-radio custom-control-inline">
          <input id="NGN" name="payment_method" type="radio" value="NGN" class="custom-control-input">
          <label class="custom-control-label" for="NGN">NGN </label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
          <input id="Bitcoin" name="payment_method" type="radio" value="Bitcoin" class="custom-control-input">
          <label class="custom-control-label" for="Bitcoin">Bitcoin</label>
      </div>
    </div> 
  </div> --}}

  @push('scripts')
    <script>
        jQuery(document).ready(function($){
            $('input[name="capital"]').keyup(function(event) {
                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40) return;
                // format number
                $(this).val(function(index, value) {
                return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                ;
                });
            });
          });
      </script>

    @endpush