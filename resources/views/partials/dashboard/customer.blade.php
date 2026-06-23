<section class="mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="box-white">
                <div class="row box-padding">
                    <div class="col-md-6">
                        <h3 class="mb-2">{{  $member->referral_code }} <small> ({{  $member->MembershipType->title_name }}) </small></h3>

                    </div>
                    <div class="col-md-6">
                    <a class="btn btn-primary btn-lg mb-2" href="#investnow" data-toggle="modal" data-target="#investnow">
                        Invest Now
                    </a>

                    <a class="btn btn-success btn-lg mb-2" href="{{url('testimonials/create')}}">
                        Share testimony
                    </a>

                    @if ($member->Investments->count() > 0 && $member->MemberAccounts->count() == 0)
                        <a href="{{ route('kyc') }}" class="btn btn-secondary btn-lg mb-2">Complete your Registration</a>
                    @endif
                    @if ($member->membership_type_id > 1)
                        {{-- @if($member->expire_at <= Carbon\Carbon::today())
                        <button type="button" class="btn btn-warning btn-lg mb-2" data-toggle="modal" data-target="#subscribe">
                            Renew
                        </button>
                        @endif --}}
                    @else

                        <a class="btn btn-danger btn-lg mb-2" href="{{url('membershiptypes/upgrade')}}">
                            Upgrade your account
                        </a>
                    @endif


                    </div>
                </div>
                {{-- @include('memberaccounts._modal') --}}
                @include('investments.createmodal')
                <div class="row box-padding" id="refer">
                    <!-- ./col -->
                    <div class="col-lg-3 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3 class="text-white">NGN {{ number_format( $member->available_balance,2)}}</h3>

                          <h5>Available Balance</h5>
                        </div>
                        <a href="{{ url('/')}}" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>

                     <!-- ./col -->
                     <div class="col-lg-3 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3 class="text-white">NGN {{ number_format( $member->ActiveInvestments->sum('capital'))}}</h3>

                          <h5>Invested Capital</h5>
                        </div>
                        <a href="{{ url ('/')}}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-sm-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3 class="text-white">{{ $member->children()->count() }} </h3>

                          <h5>Direct Referrals</h5>
                        </div>
                        <a href="{{ url('members/children', $member->id)}}" class="small-box-footer">View all  <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                          <div class="inner">
                            <h3 class="text-white">{{ $member->ActiveInvestments->count() }} </h3>

                            <h5>Active Investments</h5>
                          </div>
                          <a href="{{ url('members/children', $member->id)}}" class="small-box-footer">Invesments <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>


                </div>
                <div class="row">

                  <div class="col-md-12 mt-1 table-responsive">

                    @if ($member->PendingInvestments->count() > 0)
                      <div class="box box-primary p-l-20 p-r-20">
                        <h5 class="mt-3"> My pending Investment</h5>
                        <hr>
                        <div class="mb-table d-lg-none">
                          <div class="row">
                            @foreach ($member->PendingInvestments as $investment)
                              <div class="col-sm-6 mb-3">
                                <div class="card">
                                  <div class="py-3 px-3">
                                    <span><strong>{{$investment->InvestmentPlan->Package->name}} Investment Plan</strong></span> <br>
                                    <small><strong>Duration: </strong> {{ $investment->InvestmentPlan->duration }}</small> <br>
                                    <small><strong>Amount Invested: </strong> {{ $investment->amount_invested }}</small> <br>
                                    <small><strong>Processing Fee: </strong> {{ number_format($investment->processing_fee) }}</small> <br>
                                    <div class="row no-gutters mt-3">
                                      <div class="col-4">
                                          <a class="btn btn-secondary btn-sm" href="{{ route('investments.show', $investment->reference_code) }}">Details </a>
                                      </div>
                                      <div class="col-8">
                                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#paymentadvice21">
                                          Send Payment Notice
                                        </button>
                                         {{-- modal begins--}}
                                          <div class="modal fade" id="paymentadvice21" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                                        <form method="POST" action="{{ route('advices.store') }}" id="SendAdvice">
                                                          {{csrf_field()}}
                                                          <input type="hidden" name="payment_method" value="Offline" />
                                                          <input type="hidden" name="adviceable_type" value="bank_account" />

                                                          @include('advices._mobile_form')


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
                                      </div>
                                  </div>
                                  </div>

                                </div>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="lg-table">
                          <table class="table w-100" id="table">
                              <thead>
                                  <tr>
                                      <th >#</th>
                                      <th>Plan</th>
                                      <th>Amount Invested</th>
                                      <th>Processing Fee</th>
                                      <th>Amount Due</th>
                                      <th  width="15%">Actions</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($member->PendingInvestments as $investment)
                                  <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$investment->InvestmentPlan->Package->name}} ({{ $investment->InvestmentPlan->duration }})</td>
                                      <td>{{ $investment->amount_invested }}</td>
                                      <td>{{ number_format($investment->processing_fee) }}</td>
                                      <td><a href="{{ route('invoices.show', $investment->Invoice->id) }}">{{number_format($investment->Invoice->amount_due,2)}}</a> </td>

                                      <td>
                                          <div class="row no-gutters">
                                              <div class="col-md-3">
                                                  <a class="btn btn-secondary btn-sm" href="{{ route('investments.show', $investment->reference_code) }}"><i class="fa fa-eye"></i> </a>
                                              </div>
                                              <div class="col-md-9">
                                                @include('advices._modal_full')
                                              </div>
                                          </div>
                                      </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                          </table>

                        </div>
                      </div>
                    @endif
                  </div>
                </div>
                <div class="bg-gray box-padding">
                    <div class="row mt-2">
                      {{-- <h5> <strong>My Agent:</strong>
                        {{Auth::user()->Person->Member->Parent->Person->name ?? 'NIL'}}</h5> --}}
                        <div class="col-md-6 col-sm-6">

                            <h5 class="text-left"> Refer An Investor</h5>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" name="link" id="myLink" value="{{ config('app.url').'/investments/start/'. Auth::user()->Person->member->referral_code}}" readonly>
                                    <div class="input-group-prepend" id="button-addon4">
                                        <button onclick="myFunction()" class="btn btn-success">Copy Link</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <h6 class="text-left">Refer to 100% store</h6>
                          <div class="form-group">
                              <div class="input-group">
                                  <input type="text" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" name="link2" id="myLink2" value="{{ config('app.url').'/join/'. Auth::user()->Person->member->referral_code}}" readonly>
                                  <div class="input-group-prepend" id="button-addon4">
                                      <button onclick="myFunction2()" class="btn btn-success">Copy Link</button>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


  <div class="row">
    <div class="col-md-12 mt-4">
      <div class="box box-primary">
          <div class="box-header bg8">
              <div class="row">
                  <div class="col-md-9 col-sm-8 col-6">
                        <h5 >Orders</h5>
                  </div>
                  <div class="col-md-3 col-sm-4 col-6">
                    <form action="{{ route('orders.store') }}" method="post"
                        onsubmit="return confirm('Are you sure you want to create new order?');">
                        {{csrf_field()}}
                        <input type="hidden" id="status" name="status" value="Draft" >
                        <input type="hidden" id="member_id" name="member_id" value="{{ Auth::user()->Person->member->id}}" >
                        <button class="btn btn-success btn-sm btn-block" type="submit">Make Order </button>
                    </form>
                  </div>
              </div>
          </div>
          <div class="box-body">
           <div class="row">
            <div class="table-responsive">
                @if ($member->Orders->count() > 0)
                <table class="table w-100" id="table">
                  <thead>
                      <tr>
                          <th >#</th>
                           <th >Order No</th>
                           <th >Order Date</th>
                          <th >Cash  </th>
                          <th >Coin  </th>
                          <th >Items</th>
                          <th >Status</th>
                          <th >Details</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($member->Orders as $order)
                          <tr>
                              <td>{{$loop->iteration }}</td>
                              <td>{{$order->requisition_no}}</td>
                              <td>{{$order->scheduled_at}}</td>
                              <td>{{ $order->currency }} {{ number_format($order->OrderItems->sum('cash_amount'),2)}}</td>
                              <td> {{ number_format($order->OrderItems->sum('coin_amount'),2)}}</td>
                              <td>{{$order->OrderItems->count() }}</td>
                              <td>{{$order->status}}</td>
                              <td><a class="btn btn-danger btn-block btn-sm" href="{{ route('orders.show',$order->id) }}"><i class="fa fa-money"></i> View Details</a></td>
                          </tr>
                      @if($loop->iteration == 5)
                      @break
                      @endif
                      @endforeach
                    </tbody>
                </table>
                    @else
                    <div class="col-md-4 offset-md-4 mt-4 mb-4">
                        <div class="card card-body py-3 ">
                          <span class="text-center"> No order submitted yet</span>
                        </div>
                    </div>
                @endif
            </div>
           </div>
          </div>
      </div>
    </div>
    @if ($wishes->count() > 0)

    <div class="col-md-12 mt-4">
        <div class="box">
            <div class="box-header">
                <h5 >My Wishlist</h5>
            </div>
            <div class="box-body">
                <div class="row">
                    @foreach ($wishes as $wish)

					<div class="col-md-2 col-sm-6 mb-3">
                      <!-- Block2 -->
                      <div class="single-product">
                        <div class="product-img">
                          <img class="img-fluid w-100" src="{{ asset ($wish->Product->display_image)}}" alt="" />
                        </div>
                        <div class="product-btm">
                          <a href="{{  route('product', $wish->Product->slug) }}" class="d-block">
                            <h4> {{ $wish->Product->label }}</h4>
                          </a>
                          <div class="mt-3">
                            @if( $wish->Product->cash == '0')
                            {{ $wish->Product->coin }}  Kringles
                            @else
                            {{ $wish->Product->coin }}  Kringles + {{ $wish->Product->currency }}	{{ number_format($wish->Product->cash,2) }}
                            @endif
                          </div>
                        </div>
                      </div>
						</div>
					@endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
  </div>


</section>
