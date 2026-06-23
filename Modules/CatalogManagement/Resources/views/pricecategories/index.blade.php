@extends('layouts.admin')
@section('page_title','Price Categories')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        
    <nav aria-label ="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>                
            <li class="breadcrumb-item active" aria-current="page"> Price Categories</li>            
            <div class="ml-auto mr-0">	                  
                <a class="btn btn-success btn-sm px-3" data-toggle="modal" data-target="#new">Add Price Category</a>
                <a class="btn btn-primary px-3 btn-sm" href="{{ url('prices/manage', 'billable') }}">Billable Prices</a>
                <a class="btn btn-primary px-3 btn-sm" href="{{ url('prices/manage', 'expendable') }}">Expendable Prices</a>
            </div>
        </ol>
       @include('catalogmanagement::pricecategories.createmodal')
    </nav>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <h3 class="mb-3"> Price Categories </h3>
        <div class="table-reponsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> Category  </th>
                        <th>  Description </th>
                        <th> Status </th>
                        <th width="25%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pricecategories as $pricecategory)
                    <tr >
                        <td>{{$loop->iteration}}</td>
                        <td>{{$pricecategory->label}} </td>
                        <td>{!! $pricecategory->summary !!} </td>
                        <td>
                            @if($pricecategory->published == true)
                            <span class="enable">Enabled</span>
                            @else
                            <span class="disable">Disabled</span>
                            @endif
                        </td>

                        <td>
                            <div class="row no-gutters">

                                <div class="col-md-10">
                                    <a class="btn btn-primary btn-sm px-2" href="{{route('pricecategories.show',$pricecategory)}}">Details</a>
                                    <a class="btn btn-secondary btn-sm px-2"data-toggle="modal" data-target="#edit{{$pricecategory->id}}">
                                        Edit
                                    </a>
                                    @if($pricecategory->published == true)                 
                                    <a class="btn btn-warning btn-sm" href="{{ url('pricecategories/toggle', $pricecategory)}}">Disable</a>
                                    @else                        
                                    <a class="btn btn-success btn-sm" href="{{ url('pricecategories/toggle', $pricecategory)}}">Enable</a>
                                    @endif
                                
                                </div>
                                @if ($pricecategory->Prices->count() < 1)
                                <div class="col-md-2">
                                    <form action="{{ route('pricecategories.destroy',$pricecategory) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        {{ csrf_field() }}
                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                                    </form>
                                </div>                                    
                                @endif
                            </div>
                        </td>


                    </tr>
                    @include('catalogmanagement::pricecategories.editmodal')
                   
                    @endforeach
                </tbody>
            </table>
        </div>
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
