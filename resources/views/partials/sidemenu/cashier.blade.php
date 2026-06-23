<ul class="navbar-nav mr-auto">
    <li class="nav-item active">
    <a class="nav-link" href="{{url('/home')}}">
    <i class="fa fa-home"></i>
    Dashboard
    <span class="sr-only">(current)</span>
    </a>
</li>     

<li class="nav-item">
    <a class="nav-link" href="{{url('orders')}}">
    <i class="fa fa-shopping-cart"></i>
    Orders
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{url('inventories/manage')}}">
    <i class="fa fa-shopping-bag"></i>
   Inventory
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{url('advices/manage')}}">
    <i class="fa fa-money"></i>
    Request Quote
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{url('products/manage')}}">
    <i class="fa fa-users"></i>
    Products
    </a>
</li>
</ul>