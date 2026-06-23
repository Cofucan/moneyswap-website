@extends('layouts.admin')
@section('page_title', 'ContactType')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@endpush
@section('content')
<div class="container-fluid">
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
          <i class="fa fa-home"></i> Dashboard
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('contacts/manage')}}" class="s-text16">
          Contacts
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
          Type
        </span>
    </div>
    <div class="row p-t-10">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Contact Type</h4>
                </div>
                    <form method="POST" action="{{ route('contacts.contactType') }}" id="CreateContactType" class="p-t-10">
                            {{csrf_field()}}
                             <div class="input-group mb-3">
                                
                                <input type="text" name="contact_type" class="form-control{{ $errors->has('contact_type') ? ' is-invalid' : '' }}" class="form-control">
                                    @if ($errors->has('contact_type'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_type') }}</strong>
                                        </span>
                                    @endif
                                <div class="input-group-append" id="button-addon4">
                                    <button type="submit" class="btn btn-sm btn-primary btn-block">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                    </form>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table class="table w-100" id="table">
                                <thead>
                                    <tr>

                                        <th >Type</th>

                                        <th class="text-center" width="18%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contactTypes as $contactType)
                                        <tr>
                                            <td>{{$contactType}}</td>
                                            <td>
                                                <div class="row no-gutters">
                                                    <div class="col-md-8">

                                                        <a class="btn btn-primary btn-sm" href="{{ route('contacts.edit',$contactType) }}"><i class="fa fa-pencil"></i> Edit</a>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <form action="{{ route('contacts.destroy',$contactType) }}" method="post"
                                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            {{ csrf_field() }}
                                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>
@endpush
