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
              Enquiries
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>

            <span class="s-text17">
                Manage
            </span>
        </div>
<div class="row">
  <div class="col-md-9 content_title">
     	<h3> Enquiries </h3>
	</div>

</div>
    <div class="row ">
      <div class="col-md-12 col-sm-12 client-info ">
            <!-- <div class="table-responsive"> -->

            <table class="table w-100 " id="table">

                    <tbody>
                      @foreach ($enquiries as $day => $enquiry_list)
                      <thead>
                        <th colspan="2" style="background-color: #F7F7F7">{{ $day }}: {{ $enquiry_list->count() }} Enquiries</th>

                        <th >Contact Name</th>

                        <th >Telephone</th>
                        <th >Email</th>
                        <th  width="20%">Actions</th>
                        </thead>
                      @foreach($enquiry_list as $enquiry)
                      <tr>
                            <td>{{$enquiry->id}}</td>
                            
                            <td>{{ $enquiry->enquiry_title }}</td>
                            <td>{{$enquiry->contact_name}}</td>
                            <td>{{$enquiry->telephone}}</td>

                            <td>{{$enquiry->email }}</td>
                            <td>
                                <div class="row no-gutters">
                                    <div class="col-md-9">
                                      <a class="btn btn-secondary btn-sm" href="{{ route('enquiries.show', $enquiry->id) }}"><i class="fa fa-eye"></i></a>
                                      {{-- <a class="btn btn-primary btn-sm" href="{{ route('enquiries.edit',$enquiry->id) }}"><i class="fa fa-edit"></i> </a> --}}
                                    </div>
                                    {{-- <div class="col-md-2">
                                        <form action="{{ route('enquiries.destroy',$enquiry->id) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            {{ csrf_field() }}
                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                        </form>
                                    </div> --}}
                                </div>
                      </tr>
                      @endforeach
                      @endforeach
                    </tbody>
                </table>
<!-- </div> -->
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
