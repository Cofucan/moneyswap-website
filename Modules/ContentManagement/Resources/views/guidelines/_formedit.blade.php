{{-- address modal begins--}}
<div class="modal fade" id="editpolicy{{ $guideline->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">Edit Policy</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('guidelines.update', $guideline->id) }}" method="POST"  id="UpdateGuideline">
					{{csrf_field()}}
					@method('PUT')

					<div class="form-group">
						<label for="label">Policy Title <span class="required">*</span></label>
						<input type="text" name="label" value="{{$guideline->label}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Add Guideline Title"  id="label" required/>
						@if ($errors->has('label'))
							<span class="invalid-feedback">
							<strong>{{ $errors->first('label') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group">
						<label for="overview">Policy Details <span class="required">*</span></label>
						<textarea name="overview" class="form-control {{ $errors->has('overview') ? ' is-invalid' : '' }}" id="textarea">{{$guideline->overview}}</textarea>
						@if ($errors->has('overview'))
							<span class="invalid-feedback">
							<strong>{{ $errors->first('overview') }}</strong>
							</span>
						@endif
					</div>

					<div class="modal-footer">
						<button class="btn btn-success" type="submit">Update</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
{{-- modal ends--}}
