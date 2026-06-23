
<tr>
    <td > 
            {{$telephone->phone_number}} ( {{$telephone->phone_tag}})
    </td>  
                                          
    <td>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <a data-toggle="modal" class="btn btn-primary btn-sm" data-target="#telephone-info{{$telephone->id}}" href="#telephone-info{{$telephone->id}}">
                    Edit 
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <form action="{{ route('telephones.destroy',$telephone->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                    <input type="hidden" name="_method" value="DELETE" />
                    {{ csrf_field() }}
                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                </form>
            </div>
        </div>
    </td>
</tr>
{{--editmodal begins--}}
<div class="modal fade" id="telephone-info{{$telephone->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title text-center">Update Telephone</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div> 
            <div class="modal-body">
                <form method="POST" action="{{ route('telephones.update', $telephone->id) }}" id="UpdateCOntact">
                    {{csrf_field()}}
                    @method('PUT')
                    @include('contactmanagement::telephones._formedit')

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Save </button>
                
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
{{-- modal ends--}}