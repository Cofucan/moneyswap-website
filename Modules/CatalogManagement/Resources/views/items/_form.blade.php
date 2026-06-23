@push('styles')
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">

@endpush

<div class="form-group">
    <label class="control-label" for="cost_price">Item Name &nbsp;<span class="requiredfield">*</span></label>
    <input type="text" class="form-control" value="{{old ('label')}} " id="label" name="label" placeholder="Item Name" required>

</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" for="cost_price">Cost Price </label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                   <div class="input-group-text">NGN</div>
                </div>
                <input type="text" class="form-control" value="{{old ('cost_price')}} " id="cost_price" name="cost_price" placeholder="Amount to be paid">
            </div>
        </div>
    </div>

    
    
</div>

@push('scripts')
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

    <script>
            jQuery(document).ready(function($){
                $('input[type="radio"]').click(function(){
                var demovalue = $(this).val();
                $("div.myDiv").hide();
                $("#show"+demovalue).show();
                });
                $('input[name="cost_price"]').keyup(function(event) {

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
