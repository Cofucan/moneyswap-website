<div class="bg-ward2 text-center mb-2"><h5 >Payment Instructions</h5></div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Pay Online or directly into the school accounts shown below</h5>

                    </div>
                    <div class="card-body">
                        @foreach ($portal->School->BankAccounts as $bankaccount)
                            <div class="row info">
                                <div class="col-md-12"><span><b>A/C Name:</b> {{ $bankaccount->account_name }}</span></div>
                                <div class="col-md-3 mt-1">
                               <img src="{{ asset ($bankaccount->Bank->Organization->official_logo) }}" class="img-responsive w-100" alt="Official Logo" />
                                </div>
                                <div class="col-md-9 ">
                                        <span><b>A/C Number:</b> {{ $bankaccount->account_number }}</span><br>
                                        <span><b>Bank Purpose:</b> {{ $bankaccount->account_note }}</span>
                                </div>
                                {{-- <div class="col-md-12"><span><b>Purpose:</b> {{ $bankaccount->account_note }}</span></div> --}}
                            </div>

                            <hr>

                        @endforeach
                    </div>
                </div>
