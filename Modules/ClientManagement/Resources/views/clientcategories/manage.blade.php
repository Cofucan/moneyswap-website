@extends('layouts.admin')
@section('page_title', 'Client Attendance Type')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')


    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Client Types</li>
            <div class="ml-auto mr-0">

            </div>
        </ol>

    </nav>


    <div class="row">
      <div class="col-md-12 col-sm-12">
		    <h3> Client Atendance Types </h3>

            <div class="table-responsive-sm">
                    <table class="table w-100" id="table">
                        <thead>
                        <th style="background-color: #F7F7F7">#</th>
                            <th>Label</th>
                            <th>Description</th>
                            <th>Action</th>
                        </thead>
                            <tbody>
                            @foreach ($clientcategories as $clientcategory)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $clientcategory->label}} </td>
                                <td>{{ $clientcategory->overview}} </td>
                                <td>
                                <a class="btn btn-secondary btn-sm px-3" href="{{ route('clientcategories.show',$clientcategory) }}">Edit</a>
                                <a class="btn btn-secondary btn-sm px-3" href="#edit{{ $clientcategory }}" data-toggle="modal" data-target="#edititem{{ $clientcategory->id }}">Edit</a>
                                @if($clientcategory->published == true)
                                <a class="btn btn-warning btn-sm px-3" href="{{ url('clientcategories/toggle', $clientcategory)}}">Deactivate</a>
                                @else
                                <a class="btn btn-success btn-sm px-3" href="{{ url('clientcategories/toggle', $clientcategory)}}">Activate</a>
                                @endif


                            {{-- <div class="col-md-2">
                                <form action="{{ route('clientcategories.destroy',$clientcategory) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        {{ csrf_field() }}
                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn px-3"> <i class="fa fa-trash"></i></button>
                                </form>
                            </div> --}}


                                </td>
                            </tr>
                            @include('clientmanagement::clientcategories._modaledit')


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
