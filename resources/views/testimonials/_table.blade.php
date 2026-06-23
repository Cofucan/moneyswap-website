<div class="table-responsive">
    <table class="table" id="table">
        <thead>
            <tr>
                <th >#</th>
                <th >Thumbnail</th>
                <th >Event Title</th>
                <th >Date </th>
                <th > Page Visits</th>

                <th  width="20%">Actions</th>
            </tr>
        </thead>
        <tbody >
            @foreach($events as $event)
            <tr class="event{{$event->id}}">
                <td>{{$event->id}}</td>
                <td><img class="img-responsive w thumbnail_img d-block" src="{{  asset($event->thumbnail) }}" width="100px" height="80px" /></td>
                <td>{{$event->event_title}}</td>
                <td>{{$event->from_datetime}} - {{$event->to_datetime}}</td>
                <td> {{$event->page_views}} </td>
                <td>
                <div class="row no-gutters">
                    <div class="col-md-7">
                        <a class="btn btn-secondary btn-sm" href="{{ route('events.show', $event->id) }}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary btn-sm" href="{{ route('events.edit',$event->id) }}"><i class="fa fa-edit"></i></a>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('events.destroy',$event->id) }}" method="post"
                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                            <input type="hidden" name="_method" value="DELETE" />
                            {{ csrf_field() }}
                            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>