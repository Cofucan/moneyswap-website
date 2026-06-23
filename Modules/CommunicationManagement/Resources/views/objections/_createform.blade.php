@if(isset($invoice))
<div class="form-group mb-2">
<label for="invoice_id">Invoice Paid : {{  $invoice->ref_code }}</label>
<input type="hidden" name="invoice_id" value="{{ $invoice->id }}" id="invoice_id" />
</div>
@elseif(isset($investment))
<div class="form-group mb-2">
    <label for="invoice_id">Invoice Paid : {{  $investment->Invoice->ref_code }}</label> <br>
    <label for="invoice_id">Amount Due : {{ $investment->payment_method}} {{ number_format($investment->Invoice->amount_due)}}</label>
    <input type="hidden" name="invoice_id" value="{{ $investment->Invoice->id }}" id="invoice_id" />

</div>
@else
<div class="mb-3 form-group">
    <label for="invoice_id"> Invoice</label>
    <select name="invoice_id" class="custom-select d-block w-100 select2" id="invoice_id" required>
        @foreach($invoices as $key => $invoice)
        <option value="{{$key}}"> {{ $invoice->invoice_title }} ({{$invoice->ref_code}})</option>
        @endforeach
    </select>
    @if ($errors->has('invoice_id'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('invoice_id') }}</strong>
        </span>
    @endif
</div>
@endif 

@include('objections._form')