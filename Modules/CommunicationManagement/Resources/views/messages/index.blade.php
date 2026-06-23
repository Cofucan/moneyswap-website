@extends('layouts.admin')
@section('page_title', 'Message Inbox')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
               Messages
            </span>
        </div>
    <div class="row mt-3">
        <div class="col-md-2 col-12 col-sm-3 side-menu">
            @include('messages._menu')
        </div>
        <div class="col-md-10 p-l-20 col-sm-9 col-xs-12 mt-5">
            <div class="box">
                <div class="box-body">
                        <div class="container-fluid m-t-5 m-l-20">
                            @foreach($messages as $message)
                            <div class="row announcement ">
                                <div class="col-md-7 col-sm-5 col-12 ">
                                    <a href="{{ route('messages.show', $message->id) }}">
                                        <h6>{{  $message->message_subject }} </h6>
                                    </a>
                                </div>
                                <div class="col-md-3 col-12 col-sm-3">
                                    <span class="s-text21"><i class="fa fa-clock-o"></i>: {{ $message->created_at }} </span>
                                </div>
                                <div class="col-md-2 mt-1 col-sm-4 col-6 mobile-hid">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-1">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg{{ $message->id }}">
                                                <i class="fa fa-reply"></i>                                            
                                            </button>
                                        </div>
                                        <div class="col-md-9 col-sm-11">
                                            <a href="{{url ('/')}}" class="btn btn-sm btn-warning"><i class="fa fa-archive"></i></a>
                                            <a href="{{url ('/')}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>   
                                        
                                        {{-- <a href="{{url ('/')}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i></a> --}}
                                </div>
                                <div class="col-md-12">
                                    <div class="body mt-2">
                                        {!! str_limit($message->message_body, $limit = 100, $end = '...')!!} 
                                    </div>   
                                </div>
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
                            @endforeach
                          

                        </div>
                </div>
                    
            </div>
            {{-- <table class="table" id="table">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Email Subject</th>
                        <th >from_email</th>
                        <th > Status</th>
                        <th  width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $messagetemplate)
                    <tr class="messagetemplate{{$messagetemplate->id}}">
                        <td>{{$messagetemplate->id}}</td>
                        <td>{{$messagetemplate->message_subject}}</td>
                        <td>{{$messagetemplate->from_email}}</td>
                        <td>
                        @if($messagetemplate->published == 1)
                        <span class="enable">Published</span>
                        @else
                        <span class="disable"> Not Published</span>
                        @endif

                        </td>
                        <td>
                            <div class="row no-gutters">
                                <div class="col-md-9">
                                    <a class="btn btn-secondary btn-sm show" href="{{ route('messages.show', $messagetemplate->id) }}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('messages.edit',$messagetemplate->id) }}"><i class="fa fa-pencil"></i> </a>
                                </div>
                                <div class="col-md-3">
                                    <form action="{{ route('messages.destroy',$messagetemplate->id) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        {{ csrf_field() }}
                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td>

                    </tr>
                    @endforeach
                </tbody>
            </table> --}}
        </div>
</div>

@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
    CKEDITOR.replace( 'message_body' );
</script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>

 @endpush
