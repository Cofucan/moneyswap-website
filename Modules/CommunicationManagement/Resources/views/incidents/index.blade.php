
@extends('layouts.theme')
@section('page_title', $page->headline)
@push('style')
<link href="{{ asset ('css/incident.css')}}" rel="stylesheet">
<link href="{{ asset ('css/pages.css')}}" rel="stylesheet">
<link href="{{ asset ('css/post.css') }}" rel="stylesheet">
@endpush

@section('content')

<section id="general-hero" class="d-flex align-items-center">

  <div class="container text-center">
      <h1 class="p-t-20 p-b-20">{{$page->headline}}</h1>
  </div>

</section>



<section>
	<div class="container p-t-20 p-b-20">
	  <div class="row">

		<div class="col-lg-9 page-body">

			<h4>{{ $page->headline }}</h4>
                    {!! $page->body !!}

                    <hr>
                        <div class="panel-group" id="accordion3" role="tablist" aria-multiselectable="true">
                        @foreach($incidents as $incident)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne3">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion3" href="#collapseOne3{{ $incident->id }}" aria-expanded="true" aria-controls="collapseOne3{{ $incident->id }}">
                                           {{$incident->label}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne3{{ $incident->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne3">
                                    <div class="panel-body">
                                        {!! $incident->overview !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $incident->links }}
                        </div>



		</div>

			<div class="col-md-4 col-lg-3 p-b-10">
				<div class="left_sidebar_area">
					<aside class="left_widgets p_filter_widgets">
					  <div class="l_w_title">
						<h3>Quick Links</h3>
					  </div>
					  <div class="widgets_inner">
						<ul class="list">
							<li class="p-t-6 p-b-8 bo7">
								<a href="{{ url('/modules') }}" class="s-text13 p-t-5 p-b-5">
									Features
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="{{ url('/incidents') }}" class="s-text13 p-t-5 p-b-5">
									FAQs
								</a>
							</li>


							<li class="p-t-6 p-b-8 bo7">
								<a href="{{ url('/briefs/create') }}" class="s-text13 p-t-5 p-b-5">
									Request A Demo
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="{{ url('/contactus') }}" class="s-text13 p-t-5 p-b-5">
									Contact Us
								</a>
							</li>


						</ul>
					  </div>
					</aside>





			</div>


	</div>
</section>


  @endsection
