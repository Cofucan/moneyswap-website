 @extends('layouts.admin')
@section('page_title', 'Clients Directory')
@push('styles')
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 col-sm-6">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text16">
                    Clients Directory
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </span>

            </div>

        </div>
        <div class="row">
		        <div class="col-md-9 col-7 content_title">
		        	<h4> Clients </h4>
		        </div>

		        <div class="col-md-3 col-5">
                  {{--  @if ($formerstudents->count() > 0)
                    <a href="{{ url('clients/past') }}" class="btn btn-sm btn-danger btn-block">View Former Employee</a>
                 @endif --}}

		        </div>
              </div>
                <div class="row mt-4 mb-5">
                    @forelse ($clients as $client)

                    <div class="col-lg-3 col-md-3 col-sm-6 mb-4">
                        <!-- small box -->
                        <div class="card">
                            <div class="card-body">
                                <h5>{{$client->Admission->Profile->name}} </h5>
                                <a href="{{ route('clients.show', $client) }}">
                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                        <img src="{{asset ($client->Admission->Profile->avatar)}}" class="w-100"/>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            <span><b>{{$client->admission_no }} </b></span><br>
                                            <span> {{  $client->Level->label}}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    {{-- <ul class="pagination"> --}}
                        {{$clients->links()}}
                   {{-- </ul> --}}
                </div>

@endsection
@push('scripts')

 @endpush

