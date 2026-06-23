<div class="header-cart header-dropdown">
    <ul class="header-cart-wrapitem">
            @if(session('cart'))
            @foreach(session('cart') as $id => $details)
        <li class="header-cart-item">
            <div class="header-cart-item-img">
                <img src="{{ asset ('images/products/plasma-tv.jpg')}}" alt="IMG">
            </div>

            <div class="header-cart-item-txt">
                <a href="#" class="header-cart-item-name">
                    Plasma Tv
                </a>

                <span class="header-cart-item-info">
                        <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                </span>
            </div>
        </li>
        @endforeach
        @endif
    </ul>
    <?php $total = 0 ?>
    @foreach(session('cart') as $id => $details)
        <?php $total += $details['price'] * $details['quantity'] ?>
    @endforeach
    <div class="header-cart-total">
        Total: {{ $total }} Kringles
    </div>

    <div class="header-cart-buttons">
        <div class="header-cart-wrapbtn">
            <!-- Button -->
            <a href="{{ url('cart') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                View Cart
            </a>
        </div>

        <div class="header-cart-wrapbtn">
            <!-- Button -->
            <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                Check Out
            </a>
        </div>
    </div>
</div>
