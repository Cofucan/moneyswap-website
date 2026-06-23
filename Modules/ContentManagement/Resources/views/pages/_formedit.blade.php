<div class="form-group">
	<label for="content_title">Page Title </label>
	<input type="text" name="content_title" value="{{$page->headline}}" class="form-control" placeholder="Add Page Title"  id="content_title" />
	@if ($errors->has('content_title'))
		<span class="invalid-feedback">
		<strong>{{ $errors->first('content_title') }}</strong>
		</span>
	@endif
</div>

<div class="form-group">
	<label for="content_body">Content Body</label>
	<textarea name="content_body" value="{{$page->body }}" class="form-control" rows="7" placeholder="Add Page Content">
		{!! $page->body !!}</textarea>
	@if ($errors->has('content_body'))
		<span class="invalid-feedback">
		<strong>{{ $errors->first('content_body') }}</strong>
		</span>
	@endif
</div>


<div class="form-row">
	<div class="col-md-6">
		<img src="{{ asset ($page->thumbnail) }}" alt="{{$page->page_name }}" width="70%" height="70%">
	</div>

	<div class="col-md-6 form-group">
		<label for="display_image">Display Image</label>
		<input type="file" name="display_image" value="{{old('display_image')}}" class="form-control" placeholder="Upload Page Imaga"  id="display_image" />
		@if ($errors->has('display_image'))
			<span class="invalid-feedback">
			<strong>{{ $errors->first('display_image') }}</strong>
			</span>
		@endif
	</div>
</div>