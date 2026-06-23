<ul class="navbar-nav mr-auto">
       
<li class="nav-item active">
    <a class="nav-link" href="{{url('/home')}}">
    <i class="fa fa-home"></i>
    Dashboard
    <span class="sr-only">(current)</span>
    </a>
</li>     

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-shopping-basket"></i>
       Inventory
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">            
        <a href="{{ url('/products/manage')}}" class="dropdown-item">Products</a>
        {{-- <a href="{{ url('inventories/manage')}}" class="dropdown-item">Inventory</a> --}}
    </div>
  </li>
<li class="nav-item">
    <a class="nav-link" href="{{url('orders')}}">
    <i class="fa fa-shopping-cart"></i>
    Requisitions
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{url('deliveries')}}">
    <i class="fa fa-ship"></i>
    Delivery
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{url('shipments')}}">
    <i class="fa fa-ship"></i>
    Shipments
    </a>
</li>
</ul>