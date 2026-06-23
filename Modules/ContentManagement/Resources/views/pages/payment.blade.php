@section('page_title', 'Checkout')
@extends('layouts.theme')
@push('styles')

<link href="{{ asset ('css/modal-animate.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('vendor/noui/nouislider.min.css')}}">
@endpush
@section('content') 
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/checkout.jpg);">
		<h2 class="xl-text11 t-center">
			 
		</h2>
	</section>
 
	<!-- Cart --> 
	<section class="cart bgwhite p-t-20 p-b-20">
        <div class="container">
            <div class="row">
            <div class="col-md-5 m-l-30 m-t-20">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-muted">Revenue Info</h5>
                    </div>
                    <div class="card-body bg8">
                        <form class="form revenue-info">
                            <span> Revenue Method</span>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="paymentMethod" type="radio" class="custom-control" checked required>
                                    <label class="custom-control-label" for="credit">Credit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="debit" name="paymentMethod" type="radio" class="custom-control" required>
                                    <label class="custom-control-label" for="debit">Debit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="paymentMethod" type="radio" class="custom-control" required>
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="card_name" class="control-label">Name On Card</label>
                                <input type="text" class="form-control" id="card_name" name="card_name" placeholder="Card Name">
                                @if ($errors->has('card_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('card_name') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group ">
                                <label for="card_number" class="control-label">Card Number</label>
                                <input type="text" class="form-control" id="card_number" name="card_number" placeholder="Apartment or Suite">
                                @if ($errors->has('card_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('card_number') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="card_expiry_date">Expiry Date</label>
                                    <input type="text" class="form-control" name="card_expiry_date" id="card_expiry_date" placeholder="" required>

                                    @if ($errors->has('card_expiry_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('card_expiry_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="col-md-6 ">
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control" name="cvv" id="cvv" placeholder="" required>
                                    @if ($errors->has('cvv'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('cvv') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                                                           
                            <div class="form-row">
                                
                            </div>
                            <h6>Your Revenue is being processed </h6>
                        </form>
                    </div>
                </div>
                
            </div>
            
            
            <div class="col-md-6 p-l-50 p-t-20">
                <div class="card">
                    <div class="card-header">
                        <span class="text-muted">Your Order</span>
                        <span class="badge badge-secondary badge-pill pull-right">3</span>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-unbordered product-order"> 
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th>Product Name</th>
                                    <th>QTY</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td >
                                        <img src="images/item-cart-01.jpg" alt="IMG">   
                                    </td>
                                    <td><a href="#" class="header-cart-item-name">
                                            White Shirt With Pleat Detail Back
                                        </a>
                                    </td>
                                    <td>1</td>
                                    <td>N1,500.00</td>
                                    <td>N1,500.00</td>
                                </tr>

                                <tr>
                                    <td >
                                        <img src="images/item-cart-01.jpg" alt="IMG">   
                                    </td>
                                    <td><a href="#" class="header-cart-item-name">
                                        Converse All Star Hi Black Canvas
                                        </a>
                                    </td>
                                    <td>2</td>
                                    <td>N1,500.00</td>
                                    <td>N3,000.00</td>
                                </tr>
                                
                                <tr>
                                    <td >
                                        <img src="images/item-cart-01.jpg" alt="IMG">   
                                    </td>
                                    <td><a href="#" class="header-cart-item-name">
                                        Converse All Star Hi Black Canvas
                                        </a>
                                    </td>
                                    <td>2</td>
                                    <td>N1,500.00</td>
                                    <td>N3,000.00</td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <table class="table revenue">
                                    <tr>
                                    <th>Subtotal:</th>
                                    <td>N250.30</td>
                                    </tr>
                                    <tr>
                                    <th>VAT:</th>
                                    <td>N10.34</td>
                                    </tr>
                                    <tr>
                                    <th>Shipping:</th>
                                    <td>N5.80</td>
                                    </tr>
                                    <tr>
                                    <th>Coupon</th>
                                    <td>N1.10</td>
                                    </tr>
                                    <tr>
                                    <th>Total Due:</th>
                                    <td>N265.24</td>
                                    </tr>
                                </table>
                            </div>
                        </div>                    
                        <div class="col-md-12">
                            <button class="btn btn-success btn-block btn-sm submit">Complete Purchase</button>
                        </div>
                        <div class="revenue-info m-t-20"><h6 class="text-center">By clicking , you agree to our <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy </a></h6></div>
                    </div>
                </div>
            </div>  
				
			        
			</div>
						
        </div>
	</section>
  	
  @endsection

@push('scripts')

<script type="text/javascript" src="{{ asset ('vendor/select2/select2.min.js') }}"></script>
<script type="text/javascript">
	$(".selection-1").select2({
		minimumResultsForSearch: 20,
		dropdownParent: $('#dropDownSelect1')
	});

	$(".selection-2").select2({
		minimumResultsForSearch: 20,
		dropdownParent: $('#dropDownSelect2')
	});
</script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset ('vendor/slick/slick.min.js') }}"></script>
<script>
    $(function(){
      $('[role=dialog]')
          .on('show.bs.modal', function(e) {
            $(this)
                .find('[role=document]')
                    .removeClass()
                    .addClass('modal-dialog ' + $(e.relatedTarget).data('ui-class'))
      })
    })
</script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset ('vendor/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript">
	$('.block2-btn-addcart').each(function(){
		var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		$(this).on('click', function(){
			swal(nameProduct, "is added to cart !", "success");
		});
	});

	$('.block2-btn-addwishlist').each(function(){
		var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		$(this).on('click', function(){
			swal(nameProduct, "is added to wishlist !", "success");
		});
	});

	$('.btn-addcart-product-detail').each(function(){
		var nameProduct = $('.product-detail-name').html();
		$(this).on('click', function(){
			swal(nameProduct, "is added to wishlist !", "success");
		});
	});
</script>
@endpush