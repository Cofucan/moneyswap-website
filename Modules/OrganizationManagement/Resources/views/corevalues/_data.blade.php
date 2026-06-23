
    <tr>
        <td>{{$loop->iteration}}</td>
        <td><img src="{{asset ($value->display_image)}}" height="50px"> </td>
        <td><b>{{$value->value_title}}</b> <br>{{$value->summary }}</td>
        <td>
                @if($value->published == true)
                <span class="enable">Published</span>
                @else
                <span class="disable"> Not Published</span>
                @endif
        </td>
        <td>
            <div class="row no-gutters">
                <div class="col-md-10">
                    {{-- <a class="btn btn-secondary btn-sm show" href="{{ route('corevalues.show', $value->id) }}"><i class="fa fa-eye"></i></a> --}}
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editvalue{{$value->id}}" href="#editvalue{{ $value->id }}">Edit</a >
                    {{-- <a class="btn btn- btn-sm" href="{{ route('corevalues.edit',$value->id) }}"><i class="fa fa-edit"></i></a> --}}
                    @if($value->published == true)
                    <a class="btn btn-warning btn-sm" href="{{ url('corevalues/toggle', $value->id)}}">Unpublish</a>
                    @else
                    <a class="btn btn-success btn-sm" href="{{ url('corevalues/toggle', $value->id)}}">Publish</a>
                    @endif
                </div>
                <div class="col-md-2">
                    <form action="{{ route('corevalues.destroy',$value->id) }}" method="post"
                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                        <input type="hidden" name="_method" value="DELETE" />
                        {{ csrf_field() }}
                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </td>
    </tr>
    @include('organizationmanagement::corevalues._formedit')
