@section('page_title', 'Contact Types')
@extends('layouts.admin')
@push('styles')
 
<link href="{{ asset ('css/board.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
{{--  <link href="{{ asset ('css/modal-animate.css') }}" rel="stylesheet">  --}}
@endpush
@section('content')
   
<div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
    <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
        Contact Types
    </span>
</div>  
   
        <div class="container-fluid">
                @if ( Session::has('success') )
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{ Session::get('success') }}</strong>
                </div>
                @endif
            <div class="row">
                <div class="col-lg-8 margin-tb mb-2">
                    <div class="pull-left">
                        <button id="btn_add" name="btn_add" class="btn  btn-success">Add New Contact type</button>
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-sm-4">
            @foreach ( $data as $from )
                    {!! $from->from !!} <br>
                <a href="/showmail/{{$from ->id}}">View</a>
                <hr>
            @endforeach
        </div>
            </div>
        </div>

        <!-- Passing BASE URL to AJAX -->
        <input id="url" type="hidden" value="{{ url('contacttypes') }}">
        {{--  <input id="url" type="hidden" value="{{ \Request::url() }}">  --}}

        <!-- MODAL SECTION -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-contacttype" id="myModalLabel">Contact type Form</h4>
              </div>
              <div class="modal-body">
                <form id="frmTitles" name="frmTitles" class="form-horizontal" novalidate="">
                  <div class="form-group error">
                    <label for="inputName" class=" control-label">Name</label>
                    
                      <input type="text" class="form-control has-error" id="contact_type" name="contact_type" placeholder="Contact type Name" value="">
                    
                  </div>
                  
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" value="add">Save Changes</button>
                <input type="hidden" id="documenttype_id" name="documenttype_id" value="0">
              </div>
            </div>
          </div>
        </div>


    
@endsection
@push('scripts')
    <script src="{{asset('js/contacttypesajaxscript.js')}}"></script>
    
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
    </script>

  


@endpush




