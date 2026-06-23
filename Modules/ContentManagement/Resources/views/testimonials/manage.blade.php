@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css')}} "/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@endpush
@section('content')
    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
            <div class="ml-auto mr-0">
                <a href="{{ url('testimonials/create') }}" class="btn btn-sm btn-success">Add Testimonial</a>
            </div>
        </ol>
    </nav>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
        <h3 class="mb-3"> Testimonials </h3>
        <table class="table mt-2" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    {{-- <th>Display image</th> --}}
                    <th>Label</th>
                   <th>For whom</th>
                    <th>Status</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $testimonial)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    {{-- <td><img src="{{asset ($testimonial->display_image)}}" height="50px">  </td>   --}}
                    <td> <b> {{$testimonial->label}} </b><br>
                    {!! $testimonial->testimony !!}
                    </td>

                    <td>{{ $testimonial->for_whom }} </td>
                    <td>{{ $testimonial->status }} </td>
                    <td>
                        <div class="row no-gutters">
                            <div class="col-md-8">
                                {{-- <a class="btn btn-secondary btn-sm show" href="{{ route('testimonials.show', $testimonial->id) }}"><i class="fa fa-eye"></i></a> --}}
                                <a class="btn btn-primary btn-sm" href="#edit{{ $testimonial->id }}" data-toggle="modal" data-target="#edit{{ $testimonial->id }}">Edit</a>
                                @if($testimonial->published == true)
                                <a class="btn btn-warning btn-sm" href="{{ url('testimonials/toggle', $testimonial->id)}}">Disable</a>
                                @else
                                <a class="btn btn-success btn-sm" href="{{ url('testimonials/toggle', $testimonial->id)}}">Enable</a>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <form action="{{ route('testimonials.destroy',$testimonial->id) }}" method="post"
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
                @include('contentmanagement::testimonials.modaledit')
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>

 @endpush
