@extends('layouts.admin')
@section('page_title','Qualifications')
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
               Qualifications
            </span>
        </div>
<div class="row">
  <div class="col-md-8 content_title">

         <h3> Qualifications </h3>
         <small>

         </small>
	</div>
    <div class="col-md-2">
        <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#new-qualification">
            <i class="fa fa-plus"></i> Add Qualification
        </button>
    </div>
  <div class="col-md-2">

        {{-- modal begins--}}
        <div class="modal fade" id="new-qualification" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-center">Create new Qualification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('qualifications.store') }}" id="CreateDesignation" enctype="multipart/form-data">
                        {{csrf_field()}}

                            @include('humanresources::qualifications._form')

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
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
            <thead>
                <tr>
                    <th> #  </th>
                    <th> Qualification  </th>
                    <th> Qualification Code </th>
                    <th> Section</th>
                    <th> Status </th>

                    <th width="18%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($qualifications as $qualification)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$qualification->acronym}} </td>
                <td>{{$qualification->label}} </td>
                <td>{{$qualification->Program->label}} </td>
                <td>
                    @if($qualification->published == '1')
                    <span class="enable">Published</span>
                    @else
                    <span class="disable">Not Published </span>
                    @endif
                </td>

                <td>
                    <div class="row no-gutters">
                        {{-- <div class="col-md-4">
                            <a class="btn btn-secondary btn-sm show" href="{{ route('qualifications.show', $qualification->id) }}"><i class="fa fa-eye"></i></a>

                        </div> --}}
                        <div class="col-md-5">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#qualification{{$qualification->id}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                            {{-- modal begins--}}

                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('qualifications.destroy',$qualification->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                            </form>
                        </div>
                    </div>
                </td>
                   <div class="modal fade" id="qualification{{$qualification->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title text-center">Edit {{$qualification->acronym}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <form method="POST" action="{{ route('qualifications.update', $qualification) }}" id="UpdateDesignation" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    @method('PUT')
                                                   <input type="hidden" name="qualification_id" id="qualification_id" value="{{$qualification->id}}">
                                                    @include('humanresources::qualifications._formedit')

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
 <script>
    CKEDITOR.replace("description",
       {
           height: 100,
           // Define the toolbar streams as it is a more accessible solution.
        toolbarGroups: [{
         "name": "basicstyles",
         "streams": ["basicstyles"]
       },
       {
         "name": "links",
         "streams": ["links"]
       },
       {
         "name": "paragraph",
         "streams": ["list", "blocks"]
       },
       {
         "name": "document",
         "streams": ["mode"]
       },
       {
         "name": "insert",
         "streams": ["insert"]
       },
       {
         "name": "styles",
         "streams": ["styles"]
       },
       {
         "name": "about",
         "streams": ["about"]
       }
     ],
     // Remove the redundant buttons from toolbar streams defined above.
     removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
       });

</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function()
{
  $('.select2').select2();
});
</script>

 @endpush
