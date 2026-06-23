@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css')}} "/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<style>
  .advantage-thumb {
    width: 52px;
    height: 52px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
  }
</style>
@endpush
@section('content')
    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Advantages</li>
            <div class="ml-auto mr-0">
                <a href="{{ url('advantages/create') }}" class="btn btn-sm btn-success">Add Advantage</a>
            </div>
        </ol>
    </nav>
       
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
        <h3 class="mb-3"> Advantages </h3>
        <table class="table mt-2" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Description</th>
                   <th>For whom</th>
                    <th>Status</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($advantages as $advantage)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        @php
                            $thumb = $advantage->display_image ? asset($advantage->display_image) : asset('img/icons/upload-img.jpg');
                        @endphp
                        <img src="{{ $thumb }}" alt="{{ $advantage->label }}" class="advantage-thumb">
                    </td>
                    <td> <b> {{$advantage->label}} </b><br>
                    {!! $advantage->overview !!}
                    </td>
                
                    <td>{{ $advantage->for_whom }} </td>
                    <td>{{ $advantage->status }} </td>
                    <td>
                        <div class="row no-gutters">
                            <div class="col-md-8">
                                {{-- <a class="btn btn-secondary btn-sm show" href="{{ route('advantages.show', $advantage->id) }}"><i class="fa fa-eye"></i></a> --}}
                                <a class="btn btn-primary btn-sm" href="#edit{{ $advantage->id }}" data-toggle="modal" data-target="#edit{{ $advantage->id }}">Edit</a>
                                <a class="btn btn-info btn-sm" href="#image{{ $advantage->id }}" data-toggle="modal" data-target="#image{{ $advantage->id }}">Change Image</a>
                                @if($advantage->published == true)                 
                                <a class="btn btn-warning btn-sm" href="{{ url('advantages/toggle', $advantage->id)}}">Disable</a>
                                @else                        
                                <a class="btn btn-success btn-sm" href="{{ url('advantages/toggle', $advantage->id)}}">Enable</a>
                                @endif
                            </div> 
                            <div class="col-md-2">
                                <form action="{{ route('advantages.destroy',$advantage->id) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>

                </tr>
                @include('contentmanagement::advantages.modaledit')
                @include('contentmanagement::advantages.modalimage')
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>

 @endpush
