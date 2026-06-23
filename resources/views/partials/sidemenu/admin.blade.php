<ul class="sidebar-menu list-unstyled">
  <li class="sidebar-list-item"><a href="{{url('/home')}}" class="sidebar-link text-black"><i class="fa fa-home mr-3 text-black"></i><span>Dashboard</span></a></li>

  <li class="sidebar-list-item"><a href="{{ url('expertises/manage')}}" class="sidebar-link text-black"><i class="fa fa-window-restore mr-3 text-black"></i><span>Services</span></a></li>
  <li class="sidebar-list-item"><a href="{{ url('employees/manage')}}" class="sidebar-link text-black"><i class="fa fa-users mr-3 text-black"></i><span>Our Teams</span></a></li>
  <li class="sidebar-list-item"><a href="{{ url('enquiries')}}" class="sidebar-link text-black"><i class="fa fa-question-circle mr-3 text-black"></i><span>Enquiries</span></a></li>
 <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#cms" aria-expanded="false" aria-controls="pages" class="sidebar-link text-black"><i class="fa fa-cogs mr-3 text-black"></i><span>cms</span></a>
      <div id="cms" class="collapse">
          <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
            <li class="sidebar-list-item"><a href="{{url ('pages/manage')}}" class="sidebar-link text-black"><i class="fa fa-file-text mr-3 text-black"></i><span>Pages</span></a></li>
            <li class="sidebar-list-item"><a href="{{ url('posts/manage')}}" class="sidebar-link text-black"><i class="fa fa-file mr-3 text-black"></i><span>Blog Post</span></a></li>
            <li class="sidebar-list-item"><a href="{{url ('sliders/manage')}}" class="sidebar-link text-black"><i class="fa fa-object-ungroup mr-3 text-black"></i><span>Sliders</span></a></li>
            <li class="sidebar-list-item"><a href="{{ route('content-sections.manage', 'home') }}" class="sidebar-link text-black"><i class="fa fa-columns mr-3 text-black"></i><span>Home Sections</span></a></li>
            <li class="sidebar-list-item"><a href="{{ url('advantages/manage')}}" class="sidebar-link text-black"><i class="fa fa-video-camera mr-3 text-black"></i><span>Advantages</span></a></li>
          </ul>
      </div>
  </li>
<li class="sidebar-list-item"><a href="{{ url('howitworks/manage')}}" class="sidebar-link text-black"><i class="fa fa-file mr-3 text-black"></i><span>How it Works</span></a></li>
<li class="sidebar-list-item"><a href="{{ url('features/manage')}}" class="sidebar-link text-black"><i class="fa fa-file mr-3 text-black"></i><span>Feature</span></a></li>
<li class="sidebar-list-item"><a href="{{ url('prices/manage')}}" class="sidebar-link text-black"><i class="fa fa-money mr-3 text-black"></i><span>Prices</span></a></li>
<li class="sidebar-list-item"><a href="{{ url('faqs/manage')}}" class="sidebar-link text-black"><i class="fa fa-window-restore mr-3 text-black"></i><span>FAQ</span></a></li>

  <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#setting" aria-expanded="false" aria-controls="pages" class="sidebar-link text-black"><i class="fa fa-cogs mr-3 text-black"></i><span>Settings</span></a>
      <div id="setting" class="collapse">
          <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
              <li class="sidebar-list-item"><a href="{{ route('portals.show', 2)}}" class="sidebar-link text-black pl-lg-5">Corporate Info</a></li>
              <li class="sidebar-list-item"><a href="{{ url('designations/manage')}}" class="sidebar-link text-black pl-lg-5">Addresses</a></li>
              <!-- <li class="sidebar-list-item"><a href="{{url ('socialhandles')}}" class="sidebar-link text-black pl-lg-5">Social Media</a></li> -->
          </ul>
      </div>
  </li>
  <li class="sidebar-list-item"><a href="{{config('app_url')}}/webmail" target="_blank" class="sidebar-link text-black"><i class="fa fa-envelope mr-3 text-black"></i><span>Check Email</span></a></li>

  <li class="sidebar-list-item">
      <a href="{{ route('logout') }}"
      onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="sidebar-link text-black">
          <i class="fa fa-power-off mr-3 text-black"></i>
          <span>Logout</span>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
  </li>
</ul>
