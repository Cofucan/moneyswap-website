@section('page_title', $post->headline)
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
<link href="{{ asset ('css/blog.css')}}" rel="stylesheet">
@endpush


@section('content') 

<!-- <section class="page-image">
    <img src="{{ asset('img/news.jpg')}}">
</section> -->


  <!--==========================
      What We Do Section
    ============================-->
    <section id="page-content " class="section-padding">
        <div class="container ">
         <div class="bread-crumb flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            
            <a href="{{ url ('posts')}}" class="s-text16">
            Post
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
            {{ $post->headline  }}
            </span>
        </div>
          <div class="row">
            

            <div class="col-md-9 col-8 m-t-20">

                <div class="post-details">
                    <img src="{{ asset ($post->display_media) }}" class="img-responsive" alt="properties">
                    
                    <div class="row">
                        <div class="col-md-9 col-sm-8">
                            <h4> {{  $post->headline }}  <br><small class="category-item">
                                @foreach ($post->Classifications as $classification)
                           <a href="#">{{$classification->label }}</a>
                                @if($loop->last)
                                @break
                                @endif
                                /
                            @endforeach</small>
                        </h4>
                            
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <span><i class="fa fa-calendar">: {{$post->date_published }} </i>   | <i class="fa fa-comments">{{ $post->Comments->count() }} comment</i></span><br>
                            
                            
                        </div>
                    </div>

                     <div class="description">
                        {!! $post->story !!}

                        <div class="form-group mt-3 w-100">
                            {!! $post->video_html !!}
                        </div>
                    </div>
                        <div class="col-md-5 col-sm-6 col-6"> <span>Share on </span><br>{!! $shared !!} </div>
                        </div>
                    

                        <div class="description">
                            @if ($post->comments->count() > 0)
                               <hr class="post-line">
                            <ul>
                                @foreach($post->comments as $comment)
                                <li>{{ $comment->body }}</li>
                                @endforeach
                            </ul> 
                            @endif                            
                        </div>

            </div>
          </div>
        </div>
    </section>


  @endsection
  @push('script')

  @endpush
