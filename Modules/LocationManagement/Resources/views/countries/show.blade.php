@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{asset('css/dragndrop.css')}}">

<style>
  .myDiv{
      display:none;
  }
</style>
@endpush

@section('content')
    <div class="container">
        <nav aria-label ="breadcrumb" class="navbar-light">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{url ('home')}}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"> <a href="{{url ('countries/manage')}}"> Countries</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $country->label }}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-8">
                <h4>{{ $country->label }} <small>{{ $country->code }}</small></h4>
                <p><b>Telephone Code:</b> {{ $country->dialling_code }}</p>
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                               <h5>States in {{ $country->label }}</h5>
                            </div>
                            <div class="col-md-4">
                                <a href="#attachstate" data-toggle="modal" data-target="#attachstate" class="btn btn-success btn-sm">Add State</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body form-card">
                        @if ($country->States->count() > 0)
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>State</th>
                                        <th>Code</th>
                                        <th width="30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($country->States as $state)
                                        <tr>
                                            <td>{{ $state->name }}</td>
                                            <td>{{ $state->state_code }}</td>
                                            <td>
                                                <div class="row no-gutters">

                                                    <div class="col-md-6">
                                                        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{$state->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <form action="{{ route('states.destroy',$state->id) }}" method="post"
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
                            @else
                            <p class="text-center text-danger">No States added yet for {{ $country->label }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal begins--}}
    <div class="modal fade" id="attachstate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title text-center">Add State</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('states.store') }}" id="attachstate" >
                        {{csrf_field()}}

                        <input type="hidden" name="country_id" id="country_id" value="{{$country->id}}">

                        @include('states._form')
                        <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Save </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal ends--}}
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    jQuery(document).ready(function($){
        $('input[name="beneficiary_type"]').click(function(){
        var demovalue = $(this).val();
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
        });
    });
</script>
@endpush
