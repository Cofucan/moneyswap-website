<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$guideline->label}}</td>
    <td>{{ $guideline->updated_at }}</td>
    <td>
    @if($guideline->enabled == true)
    <span class="enable">Published</span>
    @else
    <span class="disable"> Not Published</span>
    @endif

    </td>
    <td>
        <div class="row no-gutters">
            <div class="col-md-9">
                <a class="btn btn-secondary btn-sm show" href="{{ route('guidelines.show', $guideline->id) }}"> Details </a>

                @if($guideline->enabled == true)
                <a class="btn btn-warning btn-sm" href="{{ url('guidelines/toggle', $guideline->id)}}">Unpublish</a>
                @else
                <a class="btn btn-success btn-sm" href="{{ url('guidelines/toggle', $guideline->id)}}">Publish</a>
                @endif
            </div>
            <div class="col-md-3">
                <form action="{{ route('guidelines.destroy',$guideline->id) }}" method="post"
                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                    <input type="hidden" name="_method" value="DELETE" />
                    {{ csrf_field() }}
                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                </form>
            </div>
        </div>

    </td>
</tr>
@include('contentmanagement::guidelines._formedit')

