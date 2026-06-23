<div class="card">
    <iframe width="100%" height="250" src="{{ $video->link }}" >
    </iframe>
   
    <div class="px-3 py-3">
        <h5>{{$video->label}}</h5>                       
        <p>
            <div class="row no-gutters">
                <div class="col-md-10">
                <a class="btn btn-secondary btn-sm" href="#edit{{$video->id}}" data-toggle="modal" data-target="#edit{{$video->id}}">
                Edit 
                </a>
                    @if($video->published == true)
                    <a class="btn btn-warning btn-sm" href="{{ url('videos/toggle', $video->slug)}}">Unpublish</a>
                    @else
                    <a class="btn btn-success btn-sm" href="{{ url('videos/toggle', $video->slug)}}">Publish</a>
                    @endif
                </div>
                <div class="col-md-2">
                    <form action="{{ route('videos.destroy',$video) }}" method="post"
                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                        <input type="hidden" name="_method" value="DELETE" />
                        {{ csrf_field() }}
                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </p>
    </div>
</div>
@include('contentmanagement::videos._formedit')