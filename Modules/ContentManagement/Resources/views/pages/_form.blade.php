<div class="form-group">
	<label for="content_title">Title <span class="required">*</span></label>
	<input type="text" name="content_title" value="{{old('content_title')}}" class="form-control{{ $errors->has('content_title') ? ' is-invalid' : '' }}" placeholder="Add Content Title"  id="content_title" required/>
	@if ($errors->has('content_title'))
		<span class="invalid-feedback">
		<strong>{{ $errors->first('content_title') }}</strong>
		</span>
	@endif
</div>



 <div class="form-group">
	<label for="content_body">Content Body <span class="required">*</span></label>
	<textarea name="content_body" class="form-control {{ $errors->has('content_body') ? ' is-invalid' : '' }}" rows="7" placeholder="Add Page Content">
		{{old('content_body')}}
	</textarea>
	@if ($errors->has('content_body'))
		<span class="invalid-feedback">
		<strong>{{ $errors->first('content_body') }}</strong>
		</span>
	@endif
</div>
<div class="form-row">

	<div class="col-md-6 form-group">
		<label for="display_image">Display Image</label>
		<input type="file" name="display_image" value="" class="form-control{{ $errors->has('content_body') ? ' is-invalid' : '' }}" placeholder="Upload Page Image"  id="display_image" />
		@if ($errors->has('display_image'))
			<span class="invalid-feedback">
			<strong>{{ $errors->first('display_image') }}</strong>
			</span>
		@endif
	</div>

	
