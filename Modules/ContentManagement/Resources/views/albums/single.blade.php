<div class="category-detail">
    <a href="{{url ('photos', $album)}}" ><img src="{{ asset ($album->cover) }}" alt="{{$album->label}}">
    <div class="row">
        <div class="col-md-9">
            <h6>{{ $album->label}}</h6>
        </div>
        <div class="col-md-3">
            <i class="fa fa-photo"> {{ $album->Photos->count() }}</i>
        </div>
    </div>
    </a>
</div>