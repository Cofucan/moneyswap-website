@extends('layouts.admin')
 @section('page_title', $attachment->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/career.css') }}">
@endpush
@section('content')

      <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <div class="col-md-7 col-sm-6">
          <a href="{{ url ('home')}}" class="s-text16">
              <i class="fa fa-home"></i> Dashboard
              <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
          </a>

          @if (Auth::user()->profile->role_id <> 5)
            {{-- <a href="{{ url ('assignments/manage')}}" class="s-text16">
              Assignments
              <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a> --}}
            @else
            {{-- <a href="{{ url ('assignments/manage')}}" class="s-text16">
              Assignments
              <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a> --}}
          @endif

          <span class="s-text17">
              {{ $attachment->label }}
          </span>
        </div>


      </div>
      {{-- <div class="row mb-4">
        <div class="col-md-6 content_title">
          <a href="{{ route('subjects.show', $attachment->Allocation->Subject->id) }}" class="text-blue">
                  {{ $attachment->Allocation->Subject->SubjectCategory->title_name }}</a>
        </div>
      </div> --}}

          <div class="col-xs-12 col-sm-12 col-md-6">

          </div>


        <div class="row mt-3">
          <div class="col-md-9 mb-3 content_title">
              <h4> {{ $attachment->label }}  </h4>
          </div>
          <h5>Attachments</h5>
          <a href="{{ route('books.download', $book->id) }}" class="btn btn-outline-warning">Download Cover</a>
              @foreach (json_decode($attachment->file_name) as $file)
              <a href="{{ public_path().'/files/'. $file }}" class="text-blue">{{ $file}}</a>
            @endforeach
            {{-- <img src="{{$attachment->file_name }}" alt="{{ $attachment->file_name}}" > --}}

        </div>


@endsection
