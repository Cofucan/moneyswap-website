<div class="card">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset ($post->thumbnail) }}" alt="{{$post->headline }} thumbnail" class="w-100">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="h4">{{$post->headline }}</h5>                     
                <div class="text-muted"> 
                    {!! $post->summary !!}
               </div>
                <a href="{{ url('/posts/details', $post->slug) }}" class="btn primary-btn"> Read More</a>
            </div>
        </div>
    </div>   
     
     </div>