@extends('layouts.theme')
@section('page_title', 'Shopping Cart')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/cart.css') }}">
@endpush
@section('content')

 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-section set-bg" data-setbg="{{ url('img/breadcrumb.jpg') }}">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="breadcrumb_text">
					<h2>Cart</h2>
					<div class="breadcrumb_option">
						<a href="{{ url('/') }}">Home</a>

						<span>Cart</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
	<div class="container">
		@include('partials.alert')
		<div class="row">
			<div class="col-md-9">
            <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
            <th>item</th>
            <th style="width:40%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:5%">Quantity</th>
            <th style="width:15%" class="text-center">Subtotal</th>
            <th style="width:25%"></th>
            </tr>
            </thead>
            <tbody>
            <?php $total = 0 ?>
            @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                <?php $total += $details['selling_price'] * $details['quantity'] ?>
                <tr>
                <td data-th="item">{{ $details['product_id'] }}</td>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-5 hidden-xs"><img src="{{ $details['display_image'] }}"  height="75" class="img-responsive"/></div>
                            <div class="col-sm-7">
                                <p class="nomargin">{{ $details['label'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">{{ number_format($details['selling_price']) }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
                    </td>
                    <td data-th="Subtotal" class="text-center">{{ number_format($details['selling_price'] * $details['quantity']) }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-primary btn-sm update-cart" data-id="{{ $id }}"> Update</button>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"> Remove</button>
                    </td>
                </tr>
            @endforeach
            @endif
            </tbody>
            <tfoot>
            {{-- <tr class="visible-xs">
            <td colspan="2" class="text-center"><strong>Total {{ $total }}</strong></td>
            </tr> --}}
            <tr>
            <td colspan="2"><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total {{ $total }}</strong></td>
            </tr>
            </tfoot>
            </table>
        </div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-header">
						<h5 class="text-center">Doorstep Delivery </h5>
					</div>
					<div class="card-body">
						<form action="">
							<div class="form-group">
								<select class="custom-select d-block w-100 select2" name="product_category_id" id="product">
								<option value=""> State</option>

								</select>
							</div>

							<div class="form-group">
								<select class="custom-select d-block w-100 select2" name="brand_id" id="brand">
									<option value=""> City</option>
								</select>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Product Details Section End -->
@endsection

@push('scripts')
{{-- <script src="{{ asset('js/theme/custom.js')}}" defer></script> --}}

    <script type="text/javascript" defer>
        $(".update-cart").click(function (e) {
           e.preventDefault();
           var ele = $(this);
            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endpush
