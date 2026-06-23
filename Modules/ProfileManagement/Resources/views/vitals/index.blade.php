@extends('layouts.admin')
@section('page_title', 'Ailments')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<style>
    td span{
        font-weight: 500
    }
</style>
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text16">
                    Ailments
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </span>

                <span class="s-text17">
                    Manage
                </span>
            </div>
            <div class="col-md-4">
                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#new-ailment" href="#new-ailment"><i class="fa fa-plus"></i>New Ailment</a>          

                 @include('ailments._form')
            </div>
        </div>
<div class="row">
  <div class="col-md-8 content_title">
     	<h3> Ailments </h3>
	</div>

</div>
    <div class="row mt-4">
      <div class="col-md-8 col-sm-12 col-xs-12">
           <div class="table-responsive">
        <table class="table w-100" id="table">
            <thead>
                <tr>
                    <th width="8%">#</th>

                    <th >Ailment</th>
                    <th>Status</th>
                    <th  width="20%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ailments as $ailment)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> <span>{{$ailment->name}}</span> <br> {{$ailment->overview}}</td>
                    <td>
                        @if ($ailment->published == true)
                        Published
                        @else
                        Not Publish                            
                        @endif
                    </td>
                    <td>
                        <div class="row no-gutters">
                            <div class="col-md-8">
                                @if($ailment->published == 1)                 
                                    <a class="btn btn-warning btn-sm" href="{{ url('ailments/toggle', $ailment->id)}}"><i class="fa fa-power-off"></i></a>
                                    @else                        
                                    <a class="btn btn-success btn-sm" href="{{ url('ailments/toggle', $ailment->id)}}"><i class="fa fa-play-circle-o"></i></a>
                                @endif
                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-ailment{{$ailment->id}}" href="#edit{{$ailment->id}}"> Edit</a>
                                
                            </div>
                            <div class="col-md-1">
                                <form action="{{ route('ailments.destroy',$ailment->id) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                </tr>
                @include('ailments._formedit')
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
 @endpush
