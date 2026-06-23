


    <tr>
        <td>{{$loop->iteration}}</td>
      
        <td> @if (!is_null($requirement->label)) {{ $requirement->label }} <br>
            @endif {!! $requirement->summary !!}</td>
        <td>
            <div class="row no-gutters">
                <div class="col-md-8">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{$requirement->id}}" href="#edit{{$requirement->id}}"> Edit</a>
                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#showreq{{$requirement->id}}" href="#showreq{{$requirement->id}}">Details</a>
                    @if($requirement->published == 1)
                    <a class="btn btn-warning btn-sm" href="{{ url('requirements/toggle', $requirement->id)}}"><i class="fa fa-power-off"></i></a>
                    @else
                    <a class="btn btn-success btn-sm" href="{{ url('requirements/toggle', $requirement->id)}}"><i class="fa fa-play-circle-o"></i></a>
                    @endif
                </div>
                <div class="col-md-3">
                    <form action="{{ route('requirements.destroy',$requirement->id) }}" method="post"
                        onsubmit="return confirm('Are you sure you want to delete this record?');" class=form-inline>
                        <input type="hidden" name="_method" value="DELETE" />
                        {{ csrf_field() }}
                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                    </form>
                </div>
            </div>

        </td>
    </tr>

 {{-- New Stream modal begins--}}
 <div class="modal fade" id="showreq{{$requirement->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">{{$requirement->label}} <small>  ( @if($requirement->published == 1)
                    Published
                   @else
                   Not Published
                   @endif)</small></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                {!! $requirement->overview !!}
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{$requirement->id}}" href="#edit{{$requirement->id}}"><i class="fa fa-edit"></i>  Edit</a>
            </div>
        </div>
    </div>
</div>
{{-- modal ends--}}

@include('profilemanagement::requirements._formedit')

