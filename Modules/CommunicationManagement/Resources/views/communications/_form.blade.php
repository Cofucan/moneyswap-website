                

                <div class="form-group">
                    <label for="activity_type">Activity Type</label><br>
                    <select class="custom-select w-100 select2{{ $errors->has('activity_type') ? ' is-invalid' : '' }}"  name="activity_type" id="activity_type" required>
                    <option value=""> Select Activity</option>
                    @foreach($activityTypes as $activityType)
                            @if(old('activity_type') == $activityType)
                            <option value="{{$activityType}}" selected>{{$activityType}}</option>
                                @else
                            <option value="{{$activityType}}">{{ $activityType }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('activity_type'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('activity_type') }}</strong>
                         </span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="subject"> Subject</label>
                    <input type="text" name="subject" value="{{old('subject')}}" class="form-control" placeholder="Enter Communication title"  id="subject" />
                    @if ($errors->has('subject'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('subject') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group ">
                    <label for="details">Details</label>
                    <textarea name="details" class="form-control">
                        {!! old('details') !!}
                    </textarea>
                    @if ($errors->has('details'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('details') }}</strong>
                        </span>
                    @endif
                </div>
               