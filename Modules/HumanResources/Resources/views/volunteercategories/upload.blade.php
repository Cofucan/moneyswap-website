
@extends('layouts.app')
@section('title', 'mass upload form')
@section('content')
<div class="container">

        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Upload Tool <small>Upload an excel file with all your states</small></h2>
                    <a href="{{ URL::to('exportcities/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
	                <a href="{{ URL::to('exportcities/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
	                <a href="{{ URL::to('exportcities/csv') }}"><button class="btn btn-success">Download CSV</button></a>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form action="{{ route('importcities') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        Choose your xls/csv File : <input type="file" name="file" class="form-control">
 
                     <input type="submit" class="btn btn-primary btn-lg" style="margin-top: 3%">
                 </form> 
                   
                  </div>
                </div>
              </div>
</div>
@endsection