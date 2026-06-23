@extends('layouts.admin')
@section('headline', 'Causes')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')


        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">What We Do</li>
                <div class="ml-auto mr-0">
                    <a href="{{ url('causes/create') }}" class="btn btn-sm btn-success">Add Service</a>
                </div>
            </ol>
        </nav>

        <div class="row mt-3">
            <div class="col-md-12 col-sm-12 col-xs-12 p-t-20">
                <h4>The Causes We Promote</h4>
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Service Name</th>
                            <th > Status</th>
                            <th  width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($causes as $cause)
                        <tr>
                            <td>{{$cause->id}}</td>
                            <td>{{$cause->label}}</td>
                            <td>{{ $cause->status }}</td>
                            <td>
                                <div class="row no-gutters">
                                    <div class="col-md-9">
                                        <a class="btn btn-secondary btn-sm show" href="{{ route('causes.show', $cause) }}">Details</a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('causes.edit',$cause) }}">Edit</a>
                                         @if($cause->enabled == true)
                                            <a class="btn btn-warning btn-sm" href="{{ url('causes/toggle', $cause)}}">Disable</a>
                                        @else
                                         <a class="btn btn-success btn-sm" href="{{ url('causes/toggle', $cause)}}">Enable</a>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <form action="{{ route('causes.destroy',$cause) }}" method="post"
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
@endpush
