@extends('layouts.admin')
@section('page_title', 'Payments ')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/career.css') }}">
<link rel="stylesheet" href="{{ asset ('css/hide.css') }}">
@endpush
@section('content')

<div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <div class="col-md-9 col-sm-12">
            <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text16">
               Collections
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>
        </div>
      <div class="col-md-3 col-sm-12">

        {{-- <div class="page_button text-right">
          <a class="btn btn-sm btn-primary" href=""><i class="fa fa-user-info"></i> Import</a>
          <a class="btn btn-sm btn-warning " href=""><i class="fa fa-file-o"></i> Export</a>
        </div> --}}
      </div>
    </div>
<div class="row m-t-20 m-b-20">


	<!-- ./col -->

	<div class="col-md-3  col-sm-6 col-6">
		<!-- small box -->
		<div class="small-box bg-gray-light">
			<div class="inner">
				<h3 class="text-success">{{ number_format($advices->sum('amount'),2)}}</h3>

				<h5 class="text-success">Approved Request</h5>
			</div>
			<div class="icon">
				<i class="fa fa-stack-overflow"></i>
			</div>
			<a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-md-3 col-sm-6 col-6">
		<!-- small box -->
		<div class="small-box bg-gray-light">
			<div class="inner">
				<h3 class="text-danger">{{ number_format($advices->max('amount'),2)}}</h3>

				<h5 class="text-danger">Highest Amount Paid</h5>
			</div>
			<div class="icon">
				<i class="fa fa-arrow-up"></i>
			</div>
			<a href="#" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-md-3 col-sm-6 col-6">
		<!-- small box -->
		<div class="small-box bg-gray-light">
			<div class="inner">
				<h3 class="text-primary">{{ number_format($advices->min('amount'),2)}}</h3>

				<h5 class="text-primary">Least Amount Paid</h5>
			</div>
			<div class="icon">
				<i class="fa fa-arrow-down"></i>
			</div>
			<a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

	<div class="col-md-3  col-sm-6 col-6">
		<!-- small box -->
		<div class="small-box bg-gray-light">
			<div class="inner">
				<h3 class="text-success">{{ $advices->count()}}</h3>

				<h5 class="text-success">Total Payments</h5>
			</div>
			<div class="icon">
				<i class="fa fa-file-text-o"></i>
			</div>
			<a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>

</div>

<div class="row">

	<div class="col-md-12 mt-4">
		<div class="box box-primary">
			<div class="box-header">
				<h5>Recent Payment Advises</h5>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead >
							<tr>

								<th> # </th>
								<th>
									Reference No</th>
								<th>Member Name</th>
								<th>Amount Paid</th>
								<th>Request Date</th>
								<th>Payment Method</th>

							</tr>
						</thead>
						<tbody>
							@foreach($advices as $advice)
                            <tr>
                            <td>{{$loop->iteration}}</td>
							<td><a target="_blank" href="{{ route('advices.show',$advice->id) }}">
								{{$advice->reference_code}} </a></td>
							<td>{{ $advice->Invoice->Order->Member->Person->candidate_name}}</td>
                            <td> {{ $advice->currency}} {{ number_format($advice->amount, 2)}}</td>
                            <td>{{  $advice->created_at }} </td>
                            <td>{{ $advice->payment_type }} </td>

                            </tr>
                            @endforeach


						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>

</div>


@endsection
@push('scripts')
<script>
    CKEDITOR.replace( 'article_body' );
</script>

<script>
  $(document).ready(function(){
        $(".toggle_container").hide();
        $("button.reveal").click(function(){
            $(this).toggleClass("active").next().slideToggle("fast");

            if ($.trim($(this).text()) === 'Add Article Source') {
                $(this).text('Hide Article Source');
            } else {
                $(this).text('Add Article Source');
            }

            return false;
        });
        $("a[href='" + window.location.hash + "']").parent(".reveal").click();
    });
</script>

@endpush
