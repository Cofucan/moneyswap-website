<ul class="navbar-nav mr-auto">
  <li class="nav-item active">
    <a class="nav-link" href="{{url('/home')}}">
      <i class="fa fa-home"></i>
      Dashboard
      <span class="sr-only">(current)</span>
      </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('members/products')}}">
      <i class="fa fa-clipboard"></i>
      Products
    </a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="{{url('investments/manage')}}">
      <i class="fa fa-database"></i>
      Investments
    </a>
  </li> 

  <li class="nav-item">
    <a class="nav-link" href="{{url('/member/orders')}}">
      <i class="fa fa-shopping-cart"></i>
      My Orders
    </a>
  </li>  

  <li class="nav-item">
    <a class="nav-link" href="{{url('invoices/manage')}}">
      <i class="fa fa-file-text"></i>
      Invoices
    </a>
  </li> 


    <li class="nav-item">
    <a class="nav-link" href="{{url('advices/history')}}">
      <i class="fa fa-money"></i>
      Payments
    </a>
  </li> 
</ul>