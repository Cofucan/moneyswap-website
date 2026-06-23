@extends('layouts.admin')
@section('page_title', $message->message_subject )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<style>
    .display-conversation .display-conversation {
        margin-left: 40px
    }
</style>
@endpush
@section('content')



    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-9">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <a href="{{ url ('messages')}}" class="s-text16">
                    Message
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text21">
                    [{{$message->message_subject }}]
                </span>
            </div>
            
	</div>
  
    <div class="row details mt-3">
            <div class="col-md-2 col-12 col-sm-3 side-menu">
                @include('messages._menu')
            </div>
            <div class="col-md-10 col-sm-9 p-t-20">
                    <div class="row">
                    <div class="col-md-9">
                        <h4>  {{ $message->message_subject }}</h4>
                        <div class="form-group p-t-5">
                            <strong>From :</strong>
                            {{ $message->User->email }}
                        </div>
                        <div class="form-group p-t-5">
                            <strong>To:</strong>
                            {{ $message->sender_name }}
                        </div> 
                    </div>
                    <div class="col-md-3">
                        <span class="s-text21"><i class="fa fa-clock-o"></i>: {{ $message->created_at }}</span>
                        <div class="row mt-2">
                            <div class="col-md-4 col-sm-4 col-4 mb-1">
                                <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg{{ $message->id }}">
                                    <i class="fa fa-reply"></i>                                            
                                </button>
                                {{-- modal begins--}}
                                    <div class="modal fade bd-example-modal-lg{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title text-center">Reply</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="POST" action="{{ route('messages.store') }}" id="CreateMessage" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="parent_id" value="{{ $message->id }}" class="form-control" />
                                                    <div class="form-group">
                                                        <label for="messgae_subject">Subject:</label>
                                                        {{  $message->message_subject }}
                                                    </div>
                                                    
                                                    @include('messages._form')

                                                    <div class="modal-footer">
                                                    <button class="btn btn-success" type="submit">Send Now </button>
                                                    <button class="btn btn-primary" type="reset">Reset</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- modal ends--}}
                            </div>
                            <div class="col-md-4 col-sm-4 col-4 mb-1">
                                <a href="{{url ('/')}}" class="btn btn-block btn-sm btn-warning"><i class="fa fa-archive"></i></a>
                            </div>
                            <div class="col-md-4 col-sm-4 col-4">
                                <a href="{{url ('/')}}" class="btn btn-block btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <hr>
                
                    <div class="form-group">
                        {!! $message->message_body !!}
                    </div>
                
            </div>

             

    </div>




@endsection
