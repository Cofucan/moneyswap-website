@extends('layouts.admin')
@section('page_title', 'Employee Directory')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 col-sm-6">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text16">
                    Employees Directory
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </span>

            </div>

        </div>
        <div class="row">
		        <div class="col-md-9 col-7 content_title">
		        	<h4> Employees </h4>
		        </div>

		        <div class="col-md-3 col-5">
                   

		        </div>
              </div>
                <div class="row mt-4 mb-5">
                    @forelse ($employees as $employee)

                    <div class="col-lg-3 col-md-3 col-sm-6 mb-4">
                        <!-- small box -->
                        <div class="card">
                            <div class="card-body">
                                <h5>{{$employee->Profile->full_name}} </h5>
                                <a href="{{ route('employees.show', $employee) }}">
                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                        <img src="{{asset ($employee->Profile->avatar)}}" class="w-100"/>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            <span><b>{{$employee->employee_code }} </b></span><br>
                                            <span> {{  $employee->position }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    {{$employees->links()}}
                </div>

@endsection
@push('scripts')

 @endpush
