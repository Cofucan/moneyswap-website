@extends('layouts.admin')
@section('page_title','EmployeeCategorys')
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
               Employee Categories
            </span>
        </div>
<div class="row">
  <div class="col-md-8 content_title">

         <h3> Employee Categories </h3>
         <small>

         </small>
	</div>
    <div class="col-md-2">
        <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
            <i class="fa fa-plus"></i> Add Employee Category                                         
        </button>
    </div>
  <div class="col-md-2">
	  <div class="page_button">
	 	<a href="{{ url('employeecategories/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
      </div>
        {{-- modal begins--}}
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-center">Create new Employee Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('employeecategories.store') }}" id="CreateDesignation" enctype="multipart/form-data"> 
                        {{csrf_field()}}
                                        
                            @include('employeecategories._form')

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
                    <th>#</th>
                    <th> Category  </th>
                    <th> Category Code </th>
                    <th> Status </th>
                    
                    <th width="18%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($employeecategories as $employeecategory)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$employeecategory->employee_category}} </td>
                <td>{{$employeecategory->employee_category_code}} </td>
                <td>
                    @if($employeecategory->published == '1')
                    <span class="enable">Published</span>
                    @else
                    <span class="disable">Not Published </span>
                    @endif
                </td>
                
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <a class="btn btn-secondary btn-sm show" href="{{ route('employeecategories.show', $employeecategory->id) }}"><i class="fa fa-eye"></i></a>
                            
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg{{$employeecategory->id}}">
                                <i class="fa fa-edit"></i>                                           
                            </button>
                            {{-- modal begins--}}
                                <div class="modal fade bd-example-modal-lg{{$employeecategory->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title text-center">Edit {{$employeecategory->employee_category}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <form method="POST" action="{{ route('employeecategories.update', $employeecategory->id) }}" id="UpdateDesignation" enctype="multipart/form-data"> 
                                                    {{csrf_field()}}  
                                                    @method('PUT')
                                                   <input type="hidden" name="employee_category_id" id="employee_category_id" value="{{$employeecategory->id}}">             
                                                    @include('employeecategories._formedit')
                        
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
                            <form action="{{ route('employeecategories.destroy',$employeecategory->id) }}" method="post"
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
