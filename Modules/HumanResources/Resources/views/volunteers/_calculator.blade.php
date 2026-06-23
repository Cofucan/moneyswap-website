              <div class="form-row">
                <div class="col-md-6 col-sm-6 mb-3 form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">NGN</div>
                    </div>
                    <input id="capital" type="text" value="{{ old ('capital')}}" class="form-control{{ $errors->has('capital') ? ' is-invalid' : '' }}" name="capital" placeholder="If you Invest">
                  </div>
                </div>

                <div class="col-md-6 col-sm-6 form-group">
                <select class="custom-select d-block w-100 select2" name="investment_duration_id" id="duration" required>
                    @foreach($investmentdurations as $key => $duration)
                        @if(old('investment_duration_id') == $key)
                            <option value="{{$key}}" selected> {{$duration}}</option>
                        @else
                        <option value="{{$key}}"> {{ $duration}}</option>
                        @endif
                    @endforeach
                    </select>
                    @if ($errors->has('investment_duration_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('investment_duration_id') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
              <div class="form-group mb-3">
                <div class="input-group">
                    <input type="text" name="monthly_ref" value="{{old ('monthly_ref') }}" class="form-control{{ $errors->has('monthly_ref') ? ' is-invalid' : '' }}" id="monthly_ref" placeholder="We'll Pay You" readonly>
                    <div class="input-group-append">
                      <div class="input-group-text">Monthly</div>
                    </div>
                </div>
              </div>
              <div class="mb-3 form-group">
                <input id="total_earnings" type="text" value="" class="form-control{{ $errors->has('total_earning') ? ' is-invalid' : '' }}" name="total_earning" placeholder="Total returns excluding capital" readonly>
              </div>

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
              