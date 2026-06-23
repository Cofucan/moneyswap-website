@extends('layouts.admin')
@section('headline', 'Pages')
@push('styles')    
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pages</li>
                <div class="ml-auto mr-0">
                   <a class="btn btn-success btn-sm" href="{{url('pages/create')}}">Create New Page</a>
                </div>
            </ol>
        </nav>
        
        <div class="row mt-3">
            <div class="col-md-12 col-sm-12 col-xs-12 p-t-20">
                <h4>Pages</h4>
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Title</th>                    
                            <th >Page</th>
                            <th > Last Updated</th>
                            <th > Status</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$page->headline}}</td>
                            <td>{{$page->page_tag}}</td>
                            <td>{{ $page->updated_at }}</td>   
                            <td>
                            @if($page->published == true)
                            <span class="enable">Published</span>
                            @else
                            <span class="disable"> Not Published</span>
                            @endif
                            
                            </td>  
                            <td> 
                                <div class="row no-gutters">
                                    <div class="col-md-9">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('pages.show', $page->page_tag) }}">Details</a>    
                                    <a class="btn btn-primary btn-sm" href="{{ route('pages.edit',$page->page_tag) }}">Edit </a>
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <form action="{{ route('pages.destroy',$page->page_tag) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            {{ csrf_field() }}
                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                                        </form>      
                                    </div>                          --}}
                                
                                </div>
                                
                            </td>       
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>     			
            </div>
        </div>

@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
  @endpush