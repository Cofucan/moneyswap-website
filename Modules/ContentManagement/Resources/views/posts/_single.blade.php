<div class="card">
        <a href="{{ url('/posts/details', $post->slug) }}" class="thumb">
            <img src="{{ asset ($post->thumbnail) }}" alt="{{$post->headline }} thumbnail" class="w-100" height="250px">
            <div class="card-body">
                <h5 class="h4">{{$post->headline }}</h5>                     
                <div class="text-muted"> 
                    {!! $post->summary !!}
               </div>
            </div>
             
         </a> 
     </div>