<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>

				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="id">ID</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="fid" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="state_code">City Code</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="state_code">
							</div>
						</div>
						<p class="fname_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="state_name">Last Name:</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="state_name">
							</div>
						</div>
						<p class="lname_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="population_estimate">Email</label>
							<div class="col-sm-10">
								<input type="population_estimate" class="form-control" id="population_estimate">
							</div>
						</div>
						<p class="email_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="state_id">State Name</label>
							<div class="col-sm-10">
								<select class="form-control" id="state_id" name="state_id">
									<option value="" disabled selected>Choose your option</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="longitude">Country:</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="longitude">
							</div>
						</div>
						<p
							class="country_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="latitude">Salary </label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="latitude">
							</div>
						</div>
						<p
							class="salary_error error text-center alert alert-danger hidden"></p>
					</form>
					<div class="deleteContent">
						Are you Sure you want to delete <span class="dname"></span> ? <span
							class="hidden did"></span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn actionBtn" data-dismiss="modal">
							<span id="footer_action_button" class='glyphicon'> </span>
						</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">
							<span class='glyphicon glyphicon-remove'></span> Close
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>