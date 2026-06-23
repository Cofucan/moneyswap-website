<div class="row">
               
  {{-- <div class="col-lg-4 col-xs-6 col-sm-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>0</h3>

        <h5>Warehouses</h5>
      </div>
      <div class="icon">
         <img src="{{ asset('images/icons/referrals.png') }}">
      </div>
      <a href="{{ url('invitations/manage')}}" class="small-box-footer">Total Referrals<i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div> --}}

  <!-- ./col -->
  <div class="col-lg-4 col-xs-6 col-sm-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{$products->count()}}</h3>

        <h5>Products</h5>
      </div>
      <div class="icon">
        <img src="{{ asset('images/icons/active-referrals.png') }}">
      </div>
      <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

   <!-- ./col -->
   <div class="col-lg-4 col-xs-6 col-sm-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>{{$orders->count()}}</h3>

        <h5>Sales Order</h5>
      </div>
      <div class="icon">
        <img src="{{ asset('images/icons/rewards.png') }}">
      </div>
      <a href="{{ url ('orders')}}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-4 col-xs-6 col-sm-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{{$profiles->count()}}</h3>

        <h5>Customers</h5>
      </div>
      <div class="icon">
        <img src="{{ asset('images/icons/cause.png') }}">
      </div>
      <a href="{{url('expenses/manage')}}" class="small-box-footer">View all  <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
 
  
</div>
@include('orders._modal')
<div class="row mt-4">
 <div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header">
          <div class="row ">
            <div class="col-md-4"><h5>Recent Order</h5></div>
            <div class="col-md-4 offset-md-4">
              <a href="#neworder" class="btn btn-sm  btn-block btn-success p-b-10" data-target="#neworder" data-toggle="modal">Create New Order</a>
              
            </div>
          </div>
            
        </div>
        <div class="box-body table-responsive">
            <table class="table table-striped" id="table">
                <thead>
                    <tr>
                      <th>#</th>
                        <th>Order No </th>
                        <th>Customer</th>
                        <th>Date Ordered</th>
                        <th>Status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($orders as $order)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $order->order_no }}</td>
                      <td>{{ $order->Profile->full_name}}</td>
                      <td>{{ $order->order_at }}</td>
                      <td>{{ $order->status }}</td>
                      <td> <a class="btn btn-primary btn-sm" target="_blank" href="{{ route('orders.show',$order) }}"> Details </a>      
                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
     
</div>