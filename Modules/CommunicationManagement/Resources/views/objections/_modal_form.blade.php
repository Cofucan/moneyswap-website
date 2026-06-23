@push('styles')
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
    <style>
    .myDiv2{
        display:none;
    }
    label span{
        font-size: 10px;
        color: #666;
    }
    </style>
@endpush

<input type="hidden" class="form-control" value="Initiated" id="status" name="status" placeholder="" required>
    <div class="form-row mb-2">
        <div class="col-md-12 mb-3 form-group">
            <label for="transaction_method_id" class="control-label mb-3">Payment Type</label><br>          
            @foreach ($transactionMethods as $transactionMethod)
            <div class="custom-control custom-radio custom-control-inline">
                <input id="{{$transactionMethod->code}}" name="transaction_method_id" type="radio" value="{{$transactionMethod->id}}" class="custom-control-input mb-input" required>
                <label class="custom-control-label" for="{{$transactionMethod->code}}">{{$transactionMethod->label}}</label>
              </div>
            @endforeach
          
            @if ($errors->has('transaction_method_id'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('transaction_method_id') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-12">
            <div id="displayBank" class="myDiv2">
                <div class="form-group">
                    <label for="depositor_name"> Depositor Name </label>
                    <input type="text" name="depositor_name" value="{{ old ('depositor_name') }}" class="form-control {{ $errors->has('depositor_name') ? ' is-invalid' : '' }}" placeholder=""  id="depositor_name" />
                    @if ($errors->has('depositor_name'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('depositor_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div id="displayTransfer" class="myDiv2">
            
          </div>
        </div>
    </div>   
    
    <div class="form-row">
      <div class="col-md-6 mb-3 form-group">
        <label for="bank_account_id"> Paid To:</label>
        <select name="bank_account_id" class="custom-select d-block w-100 select2" id="section" required>
          @foreach($portal->Organization->BankAccounts as $bankaccount)
            <option value="{{$bankaccount->id}}"> {{ $bankaccount->Bank->Organization->trading_name }} ({{ $bankaccount->currency }})</option>
          @endforeach
        </select>
        @if ($errors->has('bank_account_id'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('bank_account_id') }}</strong>
          </span>
        @endif
      </div> 
      <div class="col-md-6 form-group">
          <label for="reference_no"> Transaction Reference <span> (Optional )</span> </label>
          <input type="text" name="reference_no" value="{{ old ('reference_no') }}" class="form-control {{ $errors->has('reference_no') ? ' is-invalid' : '' }}" placeholder="i.e. Teller No. or Transaction reference"  id="reference_no" />
          @if ($errors->has('reference_no'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('reference_no') }}</strong>
              </span>
          @endif
      </div>
    </div>


    <div class="form-row">
        <div class="col-md-6 form-group mb-2 has-feedback">
            <label class="control-label" for="amount">Amount Paid </label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">NGN</div>
                </div>
                <input type="text" class="form-control" value="{{old ('amount')}} " id="amount" name="amount" placeholder="Amount Paid" required>
            </div>
        </div>
        <div class="col-md-6 form-group">
            <label for="paid_at"> Date Paid</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input type="text" name="paid_at" value="{{old ('paid_at')}}" class="form-control{{ $errors->has('paid_at') ? ' is-invalid' : '' }}"  id="paid_at" />
            </div>
            @if ($errors->has('paid_at'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('paid_at') }}</strong>
                </span>
            @endif

        </div>
    </div>



    <div class="form-group mb-2">
        <label for="remarks">Remark</label>
        <textarea name="remarks" id="remarks" class="form-control {{ $errors->has('remarks') ? ' is-invalid' : '' }}" rows="3" ></textarea>
    </div>




@push('scripts')
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
        jQuery(document).ready(function($) {
            $('input[name="paid_at"]').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                maxDate: moment(),
                locale: {
                format: 'YYYY-MM-DD'
                }
            });
        });
    </script>

 

    <script>
        jQuery(document).ready(function($){
            $('input[name="amount"]').keyup(function(event) {
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
