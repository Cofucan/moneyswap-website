@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
@endpush
@section('content')

<div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
    <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
       Testimonials
    </span>
</div>
<div class="row">
  <div class="col-md-8 content_title">
     	<h3>Testimonials </h3>	<small>manage all testimonies here</small>
	</div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">

            <table class="table" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Service</th>
                    <th >Person</th>
                    <th width="40%">Testimony</th>
                    <th >Status </th>
                    <th >Published </th>
                    <th  width="20%">Actions</th>
                </tr>
            </thead>
        <tbody >
            @foreach($testimonials as $testimonial)
            <tr class="testimonial{{$testimonial->id}}">
                <td>{{$loop->iteration}}</td>
                <td>{{$testimonial->service_name}}</td>
                <td>{{$testimonial->person}}</td>
                <td>{!!$testimonial->testimony!!}</td>
                <td> {{$testimonial->status}} </td>
                <td>  @if($testimonial->published == 1)
                    Published
                    @else
                    Not Published
                    @endif </td>
                <td>
                <div class="row no-gutters">
                    @if($testimonial->status == 'Pending'  && (Session::get('role_id') == 3 || Session::get('role_id') == 1 ))
                    <div class="col-md-3">
                    <form action="{{ route('testimonials.process') }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to submit this testimonial ?');">
                        {{csrf_field()}}
                        <input type="hidden" name="testimonial_id" value="{{ $testimonial->id }}">
                        <input type="hidden" name="status" value="Approved">
                        <button type="submit" class="btn btn-danger btn-sm"> Approve</button>
                    </form>

                    </div>
                    @else
                    <div class="col-md-6">
                        {{--  <a class="btn btn-secondary btn-sm" href="{{ route('testimonials.show', $testimonial->id) }}"><i class="fa fa-eye"></i></a>  --}}
                        @if($testimonial->published == 1)
                            <a class="btn btn-warning btn-sm" href="{{ url('testimonials/toggle', $testimonial->id)}}"><i class="fa fa-power-off"></i> Unpublish</a>
                            @else
                            <a class="btn btn-success btn-sm" href="{{ url('testimonials/toggle', $testimonial->id)}}"><i class="fa fa-play-circle-o"></i> Publish</a>
                        @endif
                    </div>
                    @endif

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

<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>

 @endpush
