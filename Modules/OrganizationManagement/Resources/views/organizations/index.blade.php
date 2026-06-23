@extends('layouts.admin')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@endpush
@section('content')
 
<div class="row">
		        <div class="col-md-6 content_title">
		        	<h3> Cities </h3>
		        	<small>It all starts here</small>
		        </div>

		        <div class="col-md-6">
		        	<!-- <ol class="breadcrumb">
				        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				        <li><a href="#">Examples</a></li>
				        <li class="active">Blank page</li>
				    </ol> -->
				    <div class="page_button">
		        	<button class="btn btn-sm btn-primary">Import</button>
                    <button class="btn btn-sm btn-success">Export</button>
		        	</div>
		        </div>
	      	</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            
            <table class="table" id="table"> 
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center"> Legal Name</th>
                    <th class="text-center">Common Name </th>
                    <th class="text-center">Reg Number</th>
                    <th class="text-center">Official Logo</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($cities as $organisation)
            <tr class="organisation{{$organisation->id}}">
                <td>{{$organisation->id}}</td>
                <td>{{$organisation->organization_name}}</td>
                <td>{{$organisation->common_name}}</td>
                <td>{{$organisation->reg_number}}</td>
                <td>{{$organisation->official_logo}}</td>
                
                <td><button class="edit-modal btn btn-info"
                        data-info="{{$organisation->id}},{{$organisation->first_name}},{{$organisation->last_name}},{{$organisation->population_estimate}},{{$organisation->state_id}},{{$organisation->longitude}},{{$organisation->latitude}}">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </button>
                    <button class="delete-modal btn btn-danger"
                        data-info="{{$organisation->id}},{{$organisation->first_name}},{{$organisation->last_name}},{{$organisation->population_estimate}},{{$organisation->state_id}},{{$organisation->longitude}},{{$organisation->latitude}}">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </button></td>
            </tr>
            @endforeach
            </tbody>
            </table>     			
</div>
</div>
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
							<label class="control-label col-sm-2" for="organisation_code">City Code</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="organisation_code">
							</div>
						</div>
						<p class="fname_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="organisation_name">Last Name:</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="organisation_name">
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
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>
 <script>
	
    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        var stuff = $(this).data('info').split(',');
        $('.did').text(stuff[0]);
        $('.dname').html(stuff[1] +" "+stuff[2]);
        $('#myModal').modal('show');
    });

function fillmodalData(details){
    $('#fid').val(details[0]);
    $('#organisation_code').val(details[1]);
    $('#organisation_name').val(details[2]);
    $('#population_estimate').val(details[3]);
    $('#state_id').val(details[4]);
    $('#longitude').val(details[5]);
    $('#latitude').val(details[6]);
}

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'organisation_code': $('#organisation_code').val(),
                'organisation_name': $('#organisation_name').val(),
                'population_estimate': $('#population_estimate').val(),
                'state_id': $('#state_id').val(),
                'longitude': $('#longitude').val(),
                'latitude': $('#latitude').val()
            },
            success: function(data) {
            	if (data.errors){
                	$('#myModal').modal('show');
                    if(data.errors.organisation_code) {
                    	$('.fname_error').removeClass('hidden');
                        $('.fname_error').text("First name can't be empty !");
                    }
                    if(data.errors.organisation_name) {
                    	$('.lname_error').removeClass('hidden');
                        $('.lname_error').text("Last name can't be empty !");
                    }
                    if(data.errors.population_estimate) {
                    	$('.email_error').removeClass('hidden');
                        $('.email_error').text("Email must be a valid one !");
                    }
                    if(data.errors.longitude) {
                    	$('.country_error').removeClass('hidden');
                        $('.country_error').text("Country must be a valid one !");
                    }
                    if(data.errors.latitude) {
                    	$('.salary_error').removeClass('hidden');
                        $('.salary_error').text("Salary must be a valid format ! (ex: #.##)");
                    }
                }
            	 else {
            		 
                     $('.error').addClass('hidden');
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" +
                        data.id + "</td><td>" + data.first_name +
                        "</td><td>" + data.last_name + "</td><td>" + data.population_estimate + "</td><td>" +
                         data.state_id + "</td><td>" + data.longitude + "</td><td>" + data.latitude +
                          "</td><td><button class='edit-modal btn btn-info' data-info='" + data.id+","+data.first_name+","+data.last_name+","+data.population_estimate+","+data.state_id+","+data.longitude+","+data.latitude+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + data.id+","+data.first_name+","+data.last_name+","+data.population_estimate+","+data.state_id+","+data.longitude+","+data.latitude+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

            	 }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });
</script>
 @endpush