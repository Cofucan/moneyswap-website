<div class="row m-t-20 m-b-20">

	<div class="col-md-3  col-sm-6 col-6">
		<!-- small box -->
		<div class="small-box bg-blue">
			<div class="inner">
				<h3>{{ $total->Active}}</h3>
				<h5 >Active</h5>
			</div>
			<div class="icon">
				<i class="fa fa-users"></i>
			</div>
			<a href="{{url ('clients/manage')}}" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i> View All</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-md-3 col-sm-6 col-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3 >{{ $total->Graduated }}</h3>

				<h5 >Graduated</h5>
			</div>
			<div class="icon">
				<i class="fa fa-user-md"></i>
			</div>
			<a href="{{url ('clients/manifest/Graduated')}}" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i> View All</a>
		</div>
	</div>


	<div class="col-md-3 col-sm-6 col-6">
		<!-- small box -->
		<div class="small-box bg-orange">
			<div class="inner">
				<h3>{{ $total->Discontinued}}</h3>

				<h5>Discontinued</h5>
			</div>
			<div class="icon">
				<i class="fa fa-times"></i>
			</div>
			<a href="{{url ('clients/manifest/Discontinued')}}" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i> View All</a>
		</div>
	</div>

	<div class="col-md-3  col-sm-6 col-6">
		<!-- small box -->
		<div class="small-box bg-red" >
			<div class="inner">
				<h3>{{ $total->Expelled}}</h3>

				<h5>Expelled</h5>
			</div>
			<div class="icon">
				<i class="fa fa-user-times"></i>
			</div>
			<a href="{{url ('clients/manifest/Expelled')}}" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i> View All</a>
		</div>
	</div>

</div>
