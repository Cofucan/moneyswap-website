@push('styles')
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">

@endpush

<div class="form-group">
    <label class="control-label" for="label">Price Name &nbsp;<span class="requiredfield">*</span></label>
    <input type="text" class="form-control" value="{{ old('label') }}" id="label" name="label" placeholder="Price Name" required>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" for="feature_id">Feature</label>
            <select name="feature_id" id="feature_id" class="custom-select select2">
                <option value="">-- Optional --</option>
                @foreach(($features ?? []) as $feature)
                    <option value="{{ $feature->id }}" @if(old('feature_id') == $feature->id) selected @endif>
                        {{ $feature->label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" for="price_category_id">Category &nbsp;<span class="requiredfield">*</span></label>
            <select name="price_category_id" id="price_category_id" class="custom-select select2" required>
                <option value="">Select category</option>
                @foreach(($pricecategories ?? []) as $pricecategory)
                    <option value="{{ $pricecategory->id }}"
                        @if(old('price_category_id') == $pricecategory->id || old('item_category_id') == $pricecategory->id) selected @endif>
                        {{ $pricecategory->label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" for="cost_price">Cost Price</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                   <div class="input-group-text">NGN</div>
                </div>
                <input type="text" class="form-control" value="{{ old('cost_price') }}" id="cost_price" name="cost_price" placeholder="Amount to be paid">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label" for="uom">Unit of Measure</label>
            <input type="text" class="form-control" value="{{ old('uom') }}" id="uom" name="uom" placeholder="e.g. per month, per user">
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label" for="overview">Overview</label>
    <textarea class="form-control" id="overview" name="overview" rows="3" placeholder="Short description of what is priced">{{ old('overview') }}</textarea>
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
