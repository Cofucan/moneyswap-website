			<!-- dashboard -->
			<div class="row m-t-20 m-b-20">
				<div class="col-md-6 order-md-2">
					<div class="box box-primary">
						<div class="box-header with-border">
							<div class="pull-left">
								<h5>Norminations</h5>
							</div>
							<div class="pull-right">
								<a href="{{ url('profiles/wards', Auth::user()->Profile->referral_code)}}" class="btn btn-sm btn-warning"> View All</a>
							</div>
						</div>
						<div class="box-body px-3 py-4">
								<div class="row">
									@foreach ($agent->clients as $client)
										<div class="col-md-6 mb-4">
											<div class="card px-2 py-2">
												<a href="{{ route('clients.show', $client->id) }}">
													<div class="row">
														<div class="col-md-12">
															<h5>{{$client->name}}</h5>
														</div>
														<div class="col-md-5 col-5">
															<img src="{{asset ($client->Profile->avatar)}}" class="w-100"/>
														</div>
														<div class="col-md-7 col-7">
															<span><b>{{$client->reference }} </b> </span><br>
															<span><b>Class:</b> <br>

														</div>
													</div>
												</a>
											</div>
										</div>
									@endforeach
								</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 order-md-1">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<!-- small box -->
							<div class="small-box bg-yellow">
								<div class="inner">
									<h3>0</h3>
									<h5>Revenue</h5>
								</div>
								<div class="icon">
									<i class="fa fa-user-plus"></i>
								</div>
								<a href="{{ url('/transactions/manage', Session::get('profile_id'))}}" class="small-box-footer">Revenue History <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<!-- small box -->
							<div class="small-box bg-danger">
								<div class="inner">
									<h3>0</h3>
									<h5>Oustanding Fee</h5>
								</div>
								<div class="icon">
									<i class="fa fa-reply"></i>
								</div>
								<a href="#" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>

						<div class="col-md-6 col-sm-6">
							<!-- small box -->
							<div class="small-box bg-aqua">
								<div class="inner">
									<h3>{{$profile->clients->count() }}</h3>
									<h5>My Kids</h5>
								</div>
								<div class="icon">
									<i class="fa fa-users"></i>
								</div>
								<a href="#" class="small-box-footer">View all<i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->





						<div class="col-md-6 col-sm-6">
							<!-- small box -->
							<div class="small-box bg-purple">
								<div class="inner">
									<h3>00</h3>
									<h5>Applications</h5>
								</div>
								<div class="icon">
									<i class="fa fa-file-o"></i>
								</div>
								<a href="#" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
				</div>


			</div>

			<div class="row">
				@if ($agent->uncompletedclients->count() > 0)
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							 <h5> Incomplete Orphan Profiles</h5>
						</div>
						<div class="box-body ">
							<table class="table table-striped w-100">
								<thead >
									<tr>
										<th >#</th>
										<th>Name</th>
										<th>Last Updated</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($agent->uncompletedclients as $incompleteprofile)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td><a href="{{ route('clients.show', $incompleteprofile)}}">{{$incompleteprofile->name}} </a></td>
										<td>{{ $incompleteprofile->updated_at }} </td>
									</tr>
									@endforeach
								</tbody>
							</table>

						</div>

					</div>
				</div>
				@endif

				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<div class="pull-left">
								<h5 > Announcements</h5>
							</div>
							<div class="pull-right">
								<a href="{{ url('announcements')}}" class="btn btn-sm btn-warning"> View All</a>
							</div>
						</div>
						<div class="box-body">
							@include('communicationmanagement::announcements._announcement')
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header">
							<div class="pull-left">
								<h5>Upcoming Events</h5>
							</div>
							<div class="pull-right">
										<a href="{{ url('events') }}" class="btn btn-sm btn-warning"> View All</a>
							</div>
						</div>
						<div class="box-body ">
							<div class="table-responsive">

							</div>
						</div>
					</div>
				</div>

			</div>
		<!-- ./sidemenu -->
