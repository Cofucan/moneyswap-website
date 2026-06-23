@section('page_title', 'Home')
@extends('layouts.admin')
@push('styles')

<link href="{{ asset ('css/modal-animate.css') }}" rel="stylesheet">
@endpush
@section('content')
   

    <section class="p-t-100">
      <div class="container">
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
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <button id="btn_add" name="btn_add" class="btn btn-default pull-right">Add New vacancyType</button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr class="info">
                              <th>ID </th>
                              <th>vacancyType Name</th>
                              <th>Price</th>
                              <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="vacancyTypes-list" name="vacancyTypes-list">
                            @foreach ($vacancyTypes as $vacancyType)
                              <tr id="vacancyType{{$vacancyType->id}}" class="active">
                                  <td>{{$vacancyType->id}}</td>
                                  <td>{{$vacancyType->name}}</td>
                                  <td>{{$vacancyType->price}}</td>
                                  <td width="35%">
                                      <button class="btn btn-warning btn-detail open_modal" value="{{$vacancyType->id}}">Edit</button>
                                      <button class="btn btn-danger btn-delete delete-vacancyType" value="{{$vacancyType->id}}">Delete</button>
                                  </td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Passing BASE URL to AJAX -->
        <input id="url" type="hidden" value="{{ url('vacancyTypes') }}">
        {{--  <input id="url" type="hidden" value="{{ \Request::url() }}">  --}}

        <!-- MODAL SECTION -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">vacancyType Form</h4>
              </div>
              <div class="modal-body">
                <form id="frmVacancyTypes" name="frmVacancyTypes" class="form-horizontal" novalidate="">
                  <div class="form-group error">
                    <label for="inputName" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control has-error" id="name" name="name" placeholder="vacancyType Name" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputDetail" class="col-sm-3 control-label">Price</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="">
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" value="add">Save Changes</button>
                <input type="hidden" id="vacancyType_id" name="vacancyType_id" value="1">
              </div>
            </div>
          </div>
        </div>
    </section>

    
@endsection
@push('scripts')
    <script src="{{asset('js/vacancyajaxscript.js')}}"></script>


@endpush




