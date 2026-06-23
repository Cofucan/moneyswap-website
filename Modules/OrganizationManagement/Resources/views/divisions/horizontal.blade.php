<a href="{{ url ('divisions/details', $division->slug)}}">
    <div class="item">
        <img src="{{asset ($division->display_image)}}" alt="{{$division->label}}">
        <div class="content">
          <h5>{{$division->label}}</h5>
         <p>{!! $division->summary !!}</p> 
        </div>  
    </div>          
    </a>