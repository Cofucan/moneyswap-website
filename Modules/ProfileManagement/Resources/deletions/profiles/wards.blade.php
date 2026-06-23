@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text16">
                My Children
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>


        </div>
    <div class="row">
        <div class="col-md-8 content_title">
            <h4> Children </h4>
            <p> I am the legal guardian of the underlisted children: </p>
        </div>

    </div>
    <div class="row mt-4 mb-5">
        @foreach ($clients as $client)
            <div class="col-lg-4 col-md-4 col-sm-6  mb-4">
                <div class="card px-3 py-3">
                    <a href="{{ route('clients.show', $client->id) }}">
                        <div class="row">
                            <div class="col-md-12"> <h5>{{$client->name}}</h5> </div>
                            <div class="col-md-5 col-5">
                                <img src="{{asset ($client->Profile->avatar)}}" class="w-100"/>
                            </div>
                            <div class="col-md-7 col-7">
                                <span><b>Status:</b> {{$client->enrolment_type }}</span><br>
                                @if($client->status == 'Prospective')
                                @else
                                <span><b>Admission No:</b> {{$client->admission_number }}</span><br>
                                <span><b> Class:</b> {{$client->class }}</span><br>
                                <span><b>Type:</b> {{$client->ClientCategory->student_type }}</span><br>

                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row mt-4">
        <div class="col-md-6 mt-4">
            <div class=" bg-ward">
                {{--  <h5>Attendance Chart</h5>  --}}

            </div>
        </div>
        <div class="col-md-6 mt-4">
            <div class=" bg-ward">
                {{--  <h5>Performance Chart</h5>  --}}

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
