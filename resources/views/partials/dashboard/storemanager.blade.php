<div class="row">               
  <div class="col-lg-3 col-xs-6 col-sm-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{ $requisitions->count()}}</h3>

        <h5>Approved Requisitions</h5>
      </div>
      <div class="icon">
         <i class="fa fa-shopping-basket"></i>
      </div>
      <a href="{{ url('requisitions')}}" class="small-box-footer">View all<i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6 col-sm-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{ $allrequisitions}}</h3>

        <h5>Total Requisitions</h5>
      </div>
      <div class="icon">
        <img src="{{ asset('images/icons/active-referrals.png') }}">
      </div>
      <a href="{{ url('invitations/manage')}}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <!-- ./col -->
  <div class="col-lg-3 col-xs-6 col-sm-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>{{ $products->count()}}</h3>

        <h5>Products</h5>
      </div>
      <div class="icon">
        <img src="{{ asset('images/icons/rewards.png') }}">
      </div>
      <a href="{{ ('products/manage') }}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6 col-sm-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{{ $products->count()}}</h3>

        <h5>Products</h5>
      </div>
      <div class="icon">
        <img src="{{ asset('images/icons/cause.png') }}">
      </div>
      <a href="#" class="small-box-footer">View all  <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

      <div class="row">
          
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h5>Approved Requisition</h5>
              </div>
              <div class="box-body table-responsive">
                <div class="table-responsive">
                  @include('requisitions._table')
                </div>
              </div>
            </div>
          </div>
      </div>