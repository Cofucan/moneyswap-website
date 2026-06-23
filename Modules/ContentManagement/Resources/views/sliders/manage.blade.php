@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <section>
        <div class="container">
            <nav aria-label ="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{url('home')}}"> <i class="fa fa-home"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sliders</li>
                    <div class="ml-auto mr-0">
                        <a href="{{ url('sliders/create') }}" class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></a>
                    </div>
                </ol>
            </nav>
            
            <div class="row mt-3">
                <div class="col-md-12 col-sm-12 col-xs-12 p-t-20">
                    <h4>Sliders</h4>
                    <form method="POST" action="{{ route('sliders.bulkreorder') }}" id="bulkreorder">
                        {{csrf_field()}}   
                        <table class="table" id="sliderstable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="10%">Display Image</th>
                                    <th width="33%">Slider text</th>
                                    <th width="2%">Display Order </th>
                                    <th>Status </th>
                                    <th width="26%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $slider)
                                <input type="hidden" name="slider_id[]" id="slider_id" value="{{ $slider->id }}" />
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><img src="{{ asset ($slider->display_media)}}" height="100px"></td>
                                    <td><b> {{$slider->caption}} </b> <br>
                                        {{$slider->highlight}}
                                    </td>
                                    <td><input type="number" name="sequence_no[]" id="sequence_no" value="{{$slider->sequence_no}}"> </td>
                                    <td>
                                        @if($slider->published == true)                 
                                       Enabled
                                        @else                        
                                        Disabled
                                        @endif
                                        
                                    </td>               
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-md-10">
                                                <a class="btn btn-primary btn-sm" href="{{ route('sliders.show', $slider) }}">Details</a>
                                                <a class="btn btn-secondary btn-sm" href="{{ route('sliders.edit', $slider) }}">Edit</a>
                                                @if($slider->published == true)                 
                                                <a class="btn btn-warning btn-sm" href="{{ url('sliders/toggle', $slider)}}">Disable</a>
                                                @else                        
                                                <a class="btn btn-success btn-sm" href="{{ url('sliders/toggle', $slider->id)}}">Enable</a>
                                                @endif    
                                            </div>
                                        
                                            {{-- <div class="col-md-2">
                                                <form action="{{ route('sliders.destroy',$slider->id) }}" method="post"
                                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    {{ csrf_field() }}
                                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                                </form> 
                                            </div>     --}}
                                        </div>
                                    </td>     
                                </tr>
            
                                @endforeach
                            </tbody>
                        </table>
                        <hr class="mb-4">
                        <div class="pull-right">
                            <button class="btn btn-success" type="submit">Update Order </button>
                        </div>
                    </form> 		
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
    </script>
 
 @endpush