<div class="bg-ward2 text-center mb-2"><h5 >Payments</h5></div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Account Details</h5>
                        <span >All payment should be made directly into the school accounts below:</span>
                    </div>
                    <div class="card-body">
                        @foreach ($studentfee->Payments as $payment)
                            <div class="row info">
                                <div class="col-md-12"><span> {{ $payment->payment_title }}</span></div>
                                <div class="col-md-3 mt-1">

                                </div>
                                <div class="col-md-9 ">
                                        <span><b>A/C Number:</b> {{ $payment->amount_paid }}</span><br>
                                        <span><b>Bank Purpose:</b> {{ $payment->amount_outstanding }}</span>
                                </div>
                                {{-- <div class="col-md-12"><span><b>Purpose:</b> {{ $payment->account_note }}</span></div> --}}
                            </div>

                            <hr>

                        @endforeach
                    </div>
                </div>
