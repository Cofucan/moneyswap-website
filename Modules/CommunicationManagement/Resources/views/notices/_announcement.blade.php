						@foreach($announcements as $announcement)

								<div class="announcement">
									<div class="col-md-12 ">
										<a href="{{ route('announcements.show', $announcement->id) }}">

											<div class="title">
												{{-- <div class="col-md-10 col-sm-8 col-8"> --}}
													<span class="s-text4"> {{ $announcement->publish_date }} </span>
													{{-- <p>{{ $announcement->User->full_name }}  </p> --}}
													<h6 class="">{{ $announcement->headline }}</h6>
												{{-- </div> --}}
											</div>
											<div class="body">
												{!! str_limit($announcement->body, $limit = 50, $end = '...')!!}
											</div>
										</a>
									</div>
								</div>


								@if($loop->index > 1)
									@break
									@endif
								@endforeach