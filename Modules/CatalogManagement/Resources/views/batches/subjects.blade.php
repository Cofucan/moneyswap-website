@extends('layouts.admin')
 @section('page_title', $batch->label . ' subjects')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/client.css') }}">

@endpush
@section('content')
<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"> <a href="{{ url('batches/manage')}}">Class Batch</a></li>
        <li class="breadcrumb-item"> <a href="{{ route('batches.show', $batch)}}">{{ $batch->label }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Subjects</li>
        <div class="ml-auto mr-0">
            <a class="btn btn-secondary btn-sm " href="{{ url('batches/addsubjects' , $batch) }}">Add Subjects</a>
        </div>

    </ol>
</nav>

<div class="row mt-4">
    <div class="col-md-12">
        <h3>{{ $batch->label }} </h3>
        <p><strong>Total Subjects: </strong>{{ $batch->batchsubjects->count() }}</p>
    </div>
    <div class="col-md-9">

        <div class="main mt-4">
            <div class="card">

                <div class="card-body">
                    <div class="nav-box mb-3">
                        @if($batchsubjects->count() < '1')
                        <h5 class="text-danger mt-2">No subjects available for this class</h5>
                        @else
                            <h4>Subjects </h4>
                            <hr>
                            @foreach ($batchsubjects as $term => $subject_list)
                            <div class="table-responsive">
                                <h5 class="mt-3">{{ $subject_list->count() }} Subjects in {{ $term }}</h5>
                                <table class="table w-100">
                                    @include('curriculummanagement::batchsubjects._tablehead')
                                    <tbody>
                                        @foreach($subject_list as $batchsubject)
                                        @include('curriculummanagement::batchsubjects._tabledata')
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            @endforeach

                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="col-md-3">
        <div class="box box-default">
            <div class="box-header ">
                <h5 class="pull-left">Class Officials</h5>
            </div>
            <div class="box-body">

                <div class="row">

                    @foreach ($batch->Officials as $official)
                        <div class="col-md-12 col-sm-6">
                            <div class="official-image text-center">
                            <img src="{{ asset($official->Employee->Profile->avatar) }}" alt="{{ $official->Employee->Profile->full_name}}'s picture" height="150px">
                                <p>{{ $official->Employee->Profile->full_name }} </p>
                                <h6 class="mb-3"> {{ $official->Employee->Designation->job_role }}</h6>

                                      @if (Auth::user()->Profile->role_id == 11|| Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 16)

                                        <form action="{{ route('officials.destroy',$official->id) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to remove this official from this class?');">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            {{ csrf_field() }}
                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger px-3"> Remove</button>
                                        </form>

                                    @endif



                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>



@endsection
