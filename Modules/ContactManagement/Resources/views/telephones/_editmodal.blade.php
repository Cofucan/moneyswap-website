<a data-toggle="modal" class="btn btn-primary btn-sm" data-target="#telephone-info{{$telephone->id}}" href="#telephone-info{{$telephone->id}}">
    Edit
</a>   
      {{--editmodal begins--}}
      <div class="modal fade" id="telephone-info{{$telephone->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title text-center">Update telephone</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('telephones.update', $telephone->id) }}" id="UpdateTelephone">
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

