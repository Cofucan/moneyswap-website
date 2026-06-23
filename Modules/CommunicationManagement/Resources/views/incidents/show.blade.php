@extends('layouts.admin')
@section('title', $incident->title )
@push('styles')
<style>
    p, h5{
        margin-bottom: 2px;
    }
    hr{
        margin: 5px;
    }
</style>
@endpush
@section('content')

<section>
    <div class="container">
        <nav aria-label ="breadcrumb">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('/home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                @if (Auth::user()->Profile->role_id == 1)
                <li class="breadcrumb-item"><a href="{{ url('incidents/manage') }}">Incidents</a></li>
                @elseif($incident->user_id == Auth::id()) 
                <li class="breadcrumb-item"><a href="{{ url('incidents/home') }}">Incidents</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{$incident->label }}</li>

                <div class="ml-auto mr-0">
                    @if ($incident->status == 'Scheduled')
                    <a class="btn btn-primary btn-sm" href="#editincident{{ $incident->id }}" data-toggle="modal" data-target="#editincident{{ $incident->id }}"> Edit</a>
                    @include('incidents._modaledit')    
                    @endif
                </div>
            </ol>
        </nav>

        <div class="row details">


            <div class="col-sm-8 col-md-9">
                <div class="card">                
                    <div class="card-body">                        
                        {{-- <p><b>Created By:</b> {{ $incident->User->Profile->full_name  }}</p> --}}
                        <h5>{{ $incident->label }} <small> - {{ $incident->severity  }}</small> </h5>
                        <h6><small>Last Updated: {{ $incident->updated_at }}</small></h6>
                        <p><b>Description</b></p>                       
                        <p> {!! $incident->overview !!} </p>
                        <div class="row mt-3 mb-3">
                            <div class="col-md-6">
                                <form action="{{ route('incidents.process') }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to approve this incident?');">
                                    <input type="hidden" name="incident_id" value="{{$incident->id}}" />
                                    {{ csrf_field() }}

                                    @if ($incident->status == 'Scheduled' && Auth::user()->Profile->role_id == 1)
                                    <button type="submit" name="status" class="btn btn-sm btn-primary px-3" value="Active"> Acknowledge</button>
                                    @elseif ($incident->user_id == Auth::id() || Auth::user()->Profile->role_id == 1)
                                        <button type="submit" name="status" class="btn btn-sm btn-success px-3" value="Resolved"> Resolved</button>
                                        <button type="submit" name="status" class="btn btn-sm btn-danger px-3" value="Closed"> Close</button>
                                    @endif
                                </form>
                            </div>
                        </div>                       
                        
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-9">
                     <h4>Incident Log</h4>
                    </div>
                    @if ($incident->status == 'Active' && ($incident->user_id == Auth::id() || Auth::user()->Profile->role_id == 1))                            
                    <div class="col-md-3">
                     <a class="btn btn-primary btn-sm" href="#newcomment" data-toggle="modal" data-target="#newcomment">Add Comment</a>
                     @include('comments._newcomment')    
                    </div>   
                    @endif
                    <div class="col-md-12">
                        <hr>
                            @foreach ($incident->comments as $comment)
                            <div class="bg-box mb-2">
                                <p><b>{{ $comment->User->Profile->full_name }}</b></p>
                                <p>{!! $comment->comment_body !!}</p>
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@include('partials.summernote')
@endsection
@push('scripts')


@endpush
