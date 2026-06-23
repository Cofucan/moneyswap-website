<tr>
    <td><b>{{$profaddress->full_location}}</b> ({{$profaddress->address_type}})</td>
  
    @if (Auth::user()->profile_id == $profaddress->profile_id || Auth::user()->Profile->role_id == 16)
    <td>
        <div class="row">
            <div class="col-md-3 col-6">
                <a data-toggle="modal" class="btn btn-sm btn-warning" data-target="#editaddress{{$profaddress->id}}" href="#editaddress{{$profaddress->id}}">
                    <i class="fa fa-edit"></i> 
                </a>
            </div>
            <div class="col-md-3 col-6">
                <form action="{{ route('profileaddresses.destroy',$profaddress->id) }}" method="post"
                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                    <input type="hidden" name="_method" value="DELETE" />
                    {{ csrf_field() }}
                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                </form>
            </div>
        </div>
    </td>  
    @endif  
</tr>
    {{--editmodal begins--}}
<div class="modal fade" id="editaddress{{$profaddress->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title text-center">Update Address</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('addresses.update', $profaddress->address_id) }}" id="UpdateCOntact">
                    {{csrf_field()}}
                    @method('PUT')

                    @include('profilemanagement::profileaddresses._formedit')

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Save </button>
                
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
{{-- modal ends--}}