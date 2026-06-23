<a href="{{ url ('divisions/details', $division->slug)}}">
    <div class="item">
        <img src="{{asset ($program->display_image)}}" alt="{{$program->label}}">
        <div class="content">
          <h5>{{$program->label}}</h5>
         <p>{!! $program->summary !!}</p> 
        </div>  
    </div>          
    </a>