<ul class="navbar-nav mr-auto">
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/home')}}">
        <i class="fa fa-home"></i>
        Dashboard
        <span class="sr-only">(current)</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{url('swaps/home')}}">
        <i class="fa fa-shopping-cart"></i>
        Marketplace
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('offers/manage')}}">
        <i class="fa fa-shopping-bag"></i>
       Offers
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('advices/manage')}}">
            <i class="fa fa-money"></i>
            Transactions
        </a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-globe"></i>
            Web Content
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a href="{{ url('pages/manage')}}" class="dropdown-item">Pages</a>
           <a href="{{ url('sliders/manage')}}" class="dropdown-item">Slider</a>
           <a href="{{url ('faqs/manage')}}" class="dropdown-item">FAQs</a>
           <a href="{{ url('howitworks/manage')}}" class="dropdown-item">How it Works</a>
           <a href="{{ url('advantages/manage')}}" class="dropdown-item">Advantages</a>     
           <a href="{{ url('corevalues/manage')}}" class="dropdown-item">Values</a>     
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cogs"></i>
            Settings
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a href="{{ url('countries/manage')}}" class="dropdown-item">Countries</a>
            <a href="{{ url('currencies/manage')}}" class="dropdown-item">Currencies</a>
        </div>
      </li>
      

</ul>