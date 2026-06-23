@extends('layouts.admin')
@section('page_title','Sales Cycles')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sales Cycles</li>
            <div class="ml-auto mr-0">    
                <a class="btn btn-success mx-3 btn-sm" data-toggle="modal" data-target="#addsalescycle" href="#addsalescycle">
                    Add Sales Cycle
                </a>  
            </div>
        {{-- modal begins--}}
        <div class="modal fade" id="addsalescycle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-center">Add new Sales Cycle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('salescycles.store') }}" id="CreateSalesCycle">
                            {{csrf_field()}}
                            @include('contactmanagement::salescycles._form') 

                            <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Save </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal ends--}}
        </ol>            
    </nav>     
       
<div class="row">
    <div class="col-md-8 content_title">
        <h3> Sales Cycles </h3>
    </div>
</div>
    <div class="row">
        <div class="col-md-10 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> Sales Cycle  </th>
                        <th>Sequence </th>
                        <th> Status </th>
                        <th width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salescycles as $salescycle)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$salescycle->label}} <br>{{$salescycle->overview}} </td>
                        <td> {{$salescycle->sequence}}</td>
                        <td>{{ $salescycle->visibility }} </td>

                        <td>
                            <div class="row no-gutters">
                                
                                <div class="col-md-9">

                                    <a class="btn btn-primary btn-sm mx-3" data-toggle="modal" data-target="#edit{{$salescycle->id}}">
                                        Edit
                                    </a>
                                    @if($salescycle->enabled == true)
                                    <a class="btn btn-warning btn-sm" href="{{ url('salescycles/toggle', $salescycle->id)}}">Deactivate</a>
                                    @else
                                    <a class="btn btn-success btn-sm" href="{{ url('salescycles/toggle', $salescycle->id)}}">Activate</a>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <form action="{{ route('salescycles.destroy',$salescycle->id) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        {{ csrf_field() }}
                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- modal begins--}}
                    <div class="modal fade" id="edit{{$salescycle->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center">Edit {{$salescycle->label}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('salescycles.update', $salescycle->id) }}" id="UpdateSalescycle" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        @method('PUT')

                                        @include('contactmanagement::salescycles._formedit')

                                        <div class="modal-footer">
                                            <button class="btn btn-success" type="submit">Save </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- modal ends--}}
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
