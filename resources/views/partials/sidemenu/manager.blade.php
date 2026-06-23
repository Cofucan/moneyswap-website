<ul class="navbar-nav mr-auto">
       
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/home')}}">
        <i class="fa fa-home"></i>
        Dashboard
        <span class="sr-only">(current)</span>
        </a>
    </li>     


    {{-- <li class="nav-item">
        <a class="nav-link" href="{{url('orders/home')}}">
        <i class="fa fa-shopping-cart"></i>
        Orders
        </a>
    </li> --}}
    
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-folder-o"></i>
            My Desks
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a href="{{ url('orders')}}" class="dropdown-item">Orders</a>
            <a href="{{ url('advices/manage')}}" class="dropdown-item">Payments Queue</a>
            <a href="{{ url('invoices')}}" class="dropdown-item">Invoices</a>
            <a href="{{ url('expenses')}}" class="dropdown-item">Expenses</a>
        </div>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-shopping-basket"></i>
           Catalog
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">  
            <a href="{{ url('products/manage')}}" class="dropdown-item">Products</a>
             <a href="{{ url('inventories/manage')}}" class="dropdown-item">Inventory</a>
            <a href="{{url ('categories/manage')}}" class="dropdown-item">Product Categories</a>
            <a href="{{url ('producttypes/manage')}}" class="dropdown-item">Product Types</a> 
            <a href="{{url ('brands/manage')}}" class="dropdown-item">Brands</a> 
        </div>
      </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{url('members/manage')}}">
        <i class="fa fa-users"></i>
        Members
        </a>
    </li>

  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-globe"></i>
        Contents
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
       <a href="{{ url('/posts/manage')}}" class="dropdown-item">Posts</a>
       <a href="{{ url('pages/manage')}}" class="dropdown-item">Pages</a>
       <a href="{{url ('sliders/manage')}}" class="dropdown-item">Sliders</a>
       <a href="{{url ('faqs/manage')}}" class="dropdown-item">FAQs</a>        
        <a href="{{ url('studio/manage')}}" class="dropdown-item">Manage Gallery</a>
        <a href="{{ url('testimonials')}}" class="dropdown-item">Testimonials</a>
    </div>
  </li> 
</ul>