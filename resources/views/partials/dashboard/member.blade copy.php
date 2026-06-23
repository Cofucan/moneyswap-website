<section class="mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="box-white">
                <div class="text-center mb-3">
                    {{-- <h4 class="mb-2">Membership Stage:</h4> --}}
                    <h3 class="mb-2">{{  $member->referral_code }} <small> ({{  $member->MembershipType->title_name }}) </small></h3>
                    <h5> <strong></strong>
                    </h5>
                    @if ($member->membership_type_id > 1)
                        @if($member->expire_at <= Carbon\Carbon::today())
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#subscribe">
                            Renew
                        </button>
                        @endif
                    @else
                        {{-- <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#subscribe">
                            Upgrade To 100% TBC
                        </button> --}}
                        <a class="btn btn-danger btn-sm" href="{{url('membershiptypes/upgrade')}}">
                            Upgrade your account
                        </a>
                    @endif

                        <a class="btn btn-success btn-sm" href="{{url('testimonials/create')}}">
                            Share testimony
                        </a>
                </div>


                <div class="row no-gutter mb-3" id="refer">
                    <div class="col-md-2 offset-md-2 col-sm-3 text-center">
                        <img src="{{asset ('images/icons/tbc.jpg')}}" alt="The Billion Coin">
                    </div>
                    <div class="col-md-4 col-sm-6 mt-2 text-center">
                            <h5>Available Balance: <strong>NGN {{ number_format( $member->available_balance,2)}}</strong></h5>
                            <h5>Ledger Balance: <strong>NGN {{ number_format( $member->available_balance,2)}}</strong></h5>

                            <a href="{{ url('members/children', $member->id)}}" class="btn btn-blue btn-large btn-block"> Direct Referrals: {{ $member->children()->count() }} </a>

                            {{--  <a href="{{ url('members/descendants', $member->id)}}" class="btn btn-primary  btn-sm">Total Referrals: {{ $member->descendants()->count() }} </a>  --}}


                    </div>
                    <div class="col-md-2 col-sm-3 text-center">
                        <img src="{{asset ('images/icons/bonus.jpg')}}" alt="Bonus Bag">
                    </div>

                </div>
                <div class="row mt-5">
                    {{-- <div class="col-md-3">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#invite">
                            Invite By Email/SMS
                        </button>
                    </div> --}}
                    <div class="col-md-7 offset-md-1 col-sm-7">

                        <h6 class="text-left">Earn Instant Cash on each activated referral Share your referral link</h6>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" name="link" id="myLink" value="{{ config('app.url').'/join/'. Auth::user()->Person->member->referral_code}}">
                                <div class="input-group-prepend" id="button-addon4">
                                    <button onclick="myFunction()" class="btn btn-success">Copy Link</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-5">
                        <div class="form-group mt-4">
                            <strong>My Agent:</strong>
                            {{Auth::user()->Person->Member->Parent->Person->name ?? 'NIL'}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="bg-invest text-center text-white">
                <h4 class="text-uppercase">Let your money work for you</h4>
                <h5>Invest securely with guaranteed monthly returns up to 22% ROI on your capital</h5>
                <a href="{{ url('/') }}" class="btn btn-danger">Invest Now</a>
                <a href="{{ url('investments/home') }}" class="btn btn-warning text-black">View Investments</a>
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
