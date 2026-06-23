           
           <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#paymentadvice">
              Send Payment Notice
            </button>   
            {{-- modal begins--}}
                <div class="modal fade" id="paymentadvice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-center">Payment Notification</h4>
                               
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-3"> Kindly fill the form below to notify us of any payment made but has not reflected on your profile <br>
                                    {{-- <b class="text-red">NB: Do not add "," when adding amount</b> --}}
                                </p>
                                <form method="POST" action="{{ route('objections.store') }}" id="SendAdvice">
                                    {{csrf_field()}}
									<input type="hidden" name="payment_method" value="Offline" />
									<input type="hidden" name="objectionable_type" value="bank_account" />

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
                                    <p class="text-danger">Include the invoice No in the payment description when doing transfer</p>

                                    <div class="modal-footer">
                                        <button class="btn btn-success" type="submit"> Send </button>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- modal ends--}}