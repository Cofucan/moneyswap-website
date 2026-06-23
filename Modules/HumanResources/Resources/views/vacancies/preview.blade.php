@extends('layouts.theme')
@section('page_title', 'Application Preview')
@push('style')
<link href="{{ asset ('css/admission.css')}}" rel="stylesheet">
<!-- <link href="{{ asset ('css/admission-print.css')}}" rel="stylesheet"> -->
@endpush
@section('content')

  <!--==========================
      What We Do Section
    ============================-->
        <div class="container enquiry p-b-20 p-t-20">
            <div class="row">


                <div class="col-md-10 ">
                    <h3>Application Preview</h3>
                    <hr>
                    <form>
                        <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                        <button type="button" onClick="payWithRave()">Pay Now</button>
                    </form>
                    <div class="row">
                        <div class="col-md-9">
                            @include('registrations.regdata')
                        </div>
                        <div class="col-md-3 application-id">

                                <img src="{{ asset( $vacancy->avatar )}}" class="avatar img-circle img-thumbnail" alt="{{  $vacancy->Person->vacancy_title }}">
                                <span class="text-center"> <b> {{  $vacancy->code }} </b></span>

                        </div>
                    </div>
                     <hr>
                     <div class="row">
                         <div class="col-md-2">
                             <button class="btn btn-secondary btn-sm btn-block"><i class="fa fa-edit"></i> Edit</button>
                        </div>

                        <div class="col-md-2 offset-md-6">
                            <button class="btn btn-success btn-sm btn-block" type="submit">Submit</button>
                        </div>

                        <div class="col-md-2">
                        <button class="btn btn-primary btn-sm btn-block"><i class="fa fa-print"></i> Print</button>
                        </div>
                     </div>


                </div>

                <div class="col-md-4 side">
                </div>

            </div>
        </div>

  @endsection
  @push('scripts')
  <script>
    const API_publicKey = @json(config('flutterwave.public_key'));

    function payWithRave() {
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: "dewteks@gmail.com",
            amount: 2000,
            currency: "NGN",
            txref: "rave-788790",
            subaccounts: [
              {
                id: "RS_0F72A7B741DB1E4933BED5E460F01B3D" // This assumes you have setup your commission on the dashboard.
                transaction_split_ratio:"2",
                transaction_charge_type: "flat",
                transaction_charge: "100"
              }
            ],
            meta: [{
                metaname: "MerchantID",
                metavalue: "4777036"
            }],
            onclose: function() {},
            callback: function(response) {
                var txref = response.tx.txRef; // collect flwRef returned and pass to a server page to complete status check.
                console.log("This is the response returned after a charge", response);
                if (
                    response.tx.chargeResponseCode == "00" ||
                    response.tx.chargeResponseCode == "0"
                ) {
                    // redirect to a success page
                } else {
                    // redirect to a failure page.
                }

                x.close(); // use this to close the modal immediately after revenue.
            }
        });
    }
</script>

 @endpush
