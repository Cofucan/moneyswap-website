<div class="row m-t-20 m-b-20">
	<!-- ./col -->

	<div class="col-md-3 col-6">
		<!-- small box -->
		<div class="small-box bg-gray-light">
			<div class="inner">
				<h3 class="text-purple">{{ $total->Pending}}</h3>
				<h5 class="text-purple">Pending Investments</h5>
			</div>
			<div class="icon">
				<i class="fa fa-refresh"></i>
			</div>
			<a href="{{url ('volunteers/status/Pending')}}" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-md-3 col-6">
		<!-- small box -->
		<div class="small-box bg-gray-light">
			<div class="inner">
				<h3 class="text-danger">{{ $total->Paid}}</h3>

				<h5 class="text-danger">Paid Investments</h5>
			</div>
			<div class="icon">
				<i class="fa fa-money"></i>
			</div>
			<a href="{{url ('volunteers/status/Paid')}}" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-md-3 col-6">
		<!-- small box -->
		<div class="small-box bg-gray-light">
			<div class="inner">
				<h3 class="text-success">{{ $total->Approved}}</h3>

				<h5 class="text-success">Approved Investments</h5>
			</div>
			<div class="icon">
				<i class="fa fa-check"></i>
			</div>
			<a href="{{url ('volunteers/status/Approved')}}" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>


	<div class="col-md-3 col-6">
		<!-- small box -->
		<div class="small-box bg-gray-light">
			<div class="inner">
				<h3 class="text-black">{{ $volunteers->count()}}</h3>

				<h5 class="text-black">Total Investments</h5>
			</div>
			<div class="icon">
				<i class="fa fa-file-text-o"></i>
			</div>
			<a href="{{url('volunteers/manage')}}" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

</div>