<div>
    <form action="">
                      <div class="form-group">
                          <label for="" class="control-label">I have</label>
                          <div class="input-group">
                          <input wire:model="swap_amount" type="text" class="form-control" id="swap_amount" placeholder="Enter Amount to swap">
                          <div class="input-group-prepend">
                             <select wire:model="selectedSourceCurrency" class="form-control">
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                                        @endforeach
                              </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-control-label text-muted">I Need </label>
                                    <select wire:model="selectedSwapCurrency" class="form-control">
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                              <br>
                                <div class="form-group mt-2">
                                    <button class="btn btn-block btn-danger">Find Match</button>
                                </div>
                            </div>
                        </div>


                    @if (!is_null($selectedSwapCurrency))
                    <div class="form-group">
                        <label for="" class="control-label">Recipient's get</label>
                        <div class="input-group">
                          <input type="text" name="swap_value" value="{{old ('swap_value') }}" class="form-control{{ $errors->has('swap_value') ? ' is-invalid' : '' }}" id="swap_value" placeholder="">
                          <div class="input-group-prepend">
                            <select wire:model="selectedTargetCurrency" class="custom-select d-block w-100 select2 {{ $errors->has('outlet_type') ? ' is-invalid' : '' }}"  name="target_currency_id">
                                    <option value="" selected>Recipient Currency</option>
                                    @foreach($acurrencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                                    @endforeach
                            </select>
                          </div>
                      </div>
                    </div>
                    @endif


                  </form>
</div>
