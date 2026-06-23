@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
            <span class="s-text17">
               Social handles
            </span>
        </div>
<div class="row">
  <div class="col-md-7 content_title">

         <h3> Social Handles </h3>
         <small>

         </small>
	</div>
    <div class="col-md-3">
        <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
            <i class="fa fa-plus"></i> Add Social Handle
        </button>
    </div>
  <div class="col-md-2">

        {{-- modal begins--}}
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-center">Create new Social Handle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('socialhandles.store') }}" id="CreateDesignation" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <input type="hidden" name="organization_id" id="organization_id" value="{{$portal->organization_id}}">
                            @include('socialmanagement::socialhandles._form')

                            <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Save </button>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal ends--}}
	</div>
</div>
    <div class="row">
      <div class="col-md-9 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th> Social Handle Name </th>
                    <th width="18%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($socialhandles as $socialhandle)
            <tr>
                <td>{{$socialhandle->id}}</td>
                <td> <a href="{{ $socialhandle->SocialPlatform->url }}/{{$socialhandle->handle_name}}" target="_blank"><i class="fa fa-{{ $socialhandle->SocialPlatform->icon }}"></i> {{$socialhandle->handle_name}}  </a> </td>

                <td>
                    <div class="row">

                        <div class="col-md-6">
                            <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg{{$socialhandle->id}}">
                                <i class="fa fa-edit"></i>
                            </button>
                            {{-- modal begins--}}
                                <div class="modal fade bd-example-modal-lg{{$socialhandle->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title text-center">Edit {{$socialhandle->designation}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <form method="POST" action="{{ route('socialhandles.update', $socialhandle->id) }}" id="UpdateDesignation" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    @method('PUT')
                                                    <input type="hidden" name="social_handle_id" id="social_handle_id" value="{{$socialhandle->id}}">
                                                    <input type="hidden" name="organization_id" id="organization_id" value="{{$portal->id}}">
                                                    @include('socialmanagement::socialhandles._formedit')

                                                    <div class="modal-footer">
                                                    <button class="btn btn-success" type="submit">Save </button>
                                                    <button class="btn btn-primary" type="reset">Reset</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- modal ends--}}
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('socialhandles.destroy',$socialhandle->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                            </form>
                        </div>
                    </div>
                </td>


            </tr>
            @endforeach
            </tbody>
            </table>
</div>
</div>

@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function()
{
  $('.select2').select2();
});
</script>

 @endpush
