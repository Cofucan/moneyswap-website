<section class="mt-2">
  <div class="row">               
    <div class="col-lg-3 col-xs-6 col-sm-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $warehouses->count()}}</h3>

          <h5>Warehouse</h5>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <a href="{{url('warehouses/manage')}}" class="small-box-footer">View All<i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6 col-sm-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$products->count()}}</h3>

          <h5>Total Products</h5>
        </div>
        <div class="icon">
          <i class="fa fa-shopping-basket"></i>
        </div>
        <a href="{{ url('products/manage')}}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6 col-sm-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$requisitions->count()}}</h3>

          <h5>Requisitions Submitted</h5>
        </div>
        <div class="icon">
          <i class="fa fa-folder-open"></i>
        </div>
        <a href="{{ ('requisitions') }}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6 col-sm-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ $advice->count() }}</h3>    
          <h5>Pending Payment Notice</h5>
        </div>
        <div class="icon">
          <i class="fa fa-info-circle"></i>
        </div>
        <a href="{{url('advices/pending')}}" class="small-box-footer">View all  <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="row">      
    <div class="col-md-12 mt-4">
      <div class="box box-primary">
        <div class="box-header">
          <h5>Pending Requisitions</h5>
        </div>
        <div class="box-body table-responsive">
         
        </div>
      </div>
    </div>
  </div>  
</section>
             
