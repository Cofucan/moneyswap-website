<div>
<div class="form-group">
    <label for="" class="control-label">I want to Swap</label>
        <div class="input-group">
        <input wire:model="swap_amount" type="text" class="form-control" id="swap_amount" placeholder="Enter Amount to swap">
        <div class="input-group-prepend">
        <select wire:model="selectedWalletCurrency" class="form-control">
            @foreach($causes as $cause)
                <option value="{{ $cause->reference_token }}">{{ $cause->currency_code }}</option>
            @endforeach
        </select>

        </div>
    </div>
    </div>
    @if (!is_null($selectedWalletCurrency))
    <div class="form-group">
        <label for="" class="control-label">My Exchange Rate</label>
        <div class="input-group">
        <input wire:model="swap_rate" type="text" class="form-control" id="swap_amount" placeholder="Provide preferred swap exchange rate">
        <div class="input-group-prepend">
        <select wire:model="selectedSwapCurrency" class="form-control">
            @foreach($currencies as $currency)
                <option value="{{ $currency->id }}">{{ $currency->code }}</option>
            @endforeach
            </select>
        </div>
    </div>
    </div>
    @endif
    @if (!is_null($selectedSwapCurrency))
        <div class="form-group row">
            <label for="city" class="col-md-4 col-form-label text-md-right">Swap Fee {{ $swap_fee }}</label>
            <label for="city" class="col-md-4 col-form-label text-md-right">Transaction Value {{ $amount_due }}</label>
            <label for="city" class="col-md-4 col-form-label text-md-right">Amount You'll Pay {{ $equivalent_value }} {{ $this->swapCurrency }}</label>
        </div>
    @endif
</div>
