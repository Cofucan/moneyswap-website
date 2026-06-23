  

             {{-- modal begins--}}
            <div class="modal fade " id="editaccount{{$memberaccount->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
              <div class="modal-dialog modal-md modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title text-center">Edit {{$memberaccount->account_name}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('memberaccounts.update', $memberaccount->id) }}" method="POST"  id="UpdateBankAccount" >
                          {{csrf_field()}}
                          @method('PUT')
                          
                            <div class="form-group">
                              <strong>Bank:</strong> {{$memberaccount->Bank->Organization->legal_name}}
                            </div>

                            <div class="form-group mb-3">
                                <label class="control-label" for="account_name">Account Name(required)&nbsp;<span class="requiredfield">*</span></label>
                                <input type="text" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}" value="{{$memberaccount->account_name }}" id="account_name" name="account_name" readonly>
                
                                @if ($errors->has('account_name'))
                                  <span class="invalid-feedback">
                                  <strong>{{ $errors->first('account_name') }}</strong>
                                  </span>
                                @endif
                            </div>
                
                            <div class="form-group mb-3">
                                <label class="control-label" for="account_number">Account Number(required)&nbsp;<span class="requiredfield">*</span></label>
                                <input type="text" class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}" value="{{$memberaccount->account_number}}" id="account_number" name="account_number" >
                
                                @if ($errors->has('account_number'))
                                  <span class="invalid-feedback">
                                  <strong>{{ $errors->first('account_number') }}</strong>
                                  </span>
                                @endif
                            </div>
                
                            <div class="form-group mb-3">
                                <label class="control-label" for="currency">Currency</label>
                                <select class="custom-select d-block w-100 select2{{ $errors->has('currency') ? ' is-invalid' : '' }}"  name="currency" id="currency" required>
                                @foreach($currencies as $key => $currency)
                                @if($memberaccount->currency ==  $key)
                                  <option value="{{  $key}}" selected>{{$currency}} </option>
                                  @else
                                  <option value="{{  $key}}"> {{$currency}} </option>
                                @endif
                              @endforeach
                                </select>
                    
                                @if ($errors->has('currency'))
                                  <span class="invalid-feedback">
                                  <strong>{{ $errors->first('currency') }}</strong>
                                  </span>
                                @endif
                            </div>
                
                            <div class="form-group mb-3">
                                <label class="control-label" for="account_note">Account Note</label>
                                <input type="text" class="form-control{{ $errors->has('account_note') ? ' is-invalid' : '' }}" value="{{$memberaccount->account_note}}" id="account_note" name="account_note" >
                
                                @if ($errors->has('account_note'))
                                  <span class="invalid-feedback">
                                  <strong>{{ $errors->first('account_note') }}</strong>
                                  </span>
                                @endif
                            </div>

                          <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Save </button>
                          </div>
                        </form>
                      </div>
                  </div>
              </div>
          </div>
      {{-- modal ends--}}
           