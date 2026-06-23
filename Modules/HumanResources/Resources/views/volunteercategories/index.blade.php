@extends('layouts.admin')
@section('page_title', 'People working for people')

@push('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset("/plugins/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css")}}">
@endpush
@section('content_title', 'Add New Project')
@section('page_actions')
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>
<a class="btn btn-success" href="{{ route('communities.create') }}"> Create New Community</a>
@include('temp.create_modal')   
@endsection
@section('content')

<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Page title <small>Users</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                            {{ $message }}
                            </div>
                        @endif
                    </p>
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th> No </th>
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Location</th>
                          <th>Age</th>
                          <th>Start date</th>
                          <th>Salary</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($communities as $community)
                        <tr>
                        <td>{{ ++$i }}</td>
                          <td>{{ $community->name }}</td>
                          <td>{{ $community->name }}</td>
                          <td>{{ $community->name }}</td>
                          <td>{{ $community->name }}</td>
                          <td>{{ $community->name }}</td>
                          <td>{{ $community->name }}</td>
                          <td>
                            <form action="{{ route('communities.destroy',$community->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('communities.show',$community->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('communities.edit',$community->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('shares.edit',$share->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                            </tr>
                      @endforeach    
                      </tbody>
                    </table>
                    {!! $communities->links() !!}
                  </div>
                </div>
              </div>
</div>

@endsection
@push('scripts')

<<!-- DataTables -->
<script src="{{ asset("/plugins/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("/plugins/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js")}}"></script>

@endpush