<div class="modal fade" id="reactivate{{$level->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Reactivate Client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('clients.activation') }}" id="BulkActivate">
                    {{csrf_field()}}
                    <input type="hidden" name="current_grade_id" value="{{ $level->id }}">
                    @method('PUT')
                    <div class="form-group">
                        <strong>Current Class: </strong> {{$level->label}}
                    </div>

                    <div class="mb-3 form-group">
                        <label for="academic_term_id"> Enrolment Term</label>
                        <select name="academic_term_id" class="custom-select d-block w-100 select2" id="academicterm" required>
                          <option value=""> Select Academic Term</option>
                          @foreach($academicTerms as $key => $academicterm)
                            @if($currentterm->id == $key)
                            <option value="{{$key}}" selected> {{$academicterm }}</option>
                                @else
                            <option value="{{$key}}"> {{$academicterm }}</option>
                            @endif
                          @endforeach
                        </select>
                        @if ($errors->has('academic_term_id'))
                          <span class="invalid-feedback">
                            <strong>{{ $errors->first('academic_term_id') }}</strong>
                          </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="grade_id">Enrolment Class</label>
                        <select class="custom-select d-block w-100 select2"  name="grade_id" id="grade_id">
                            @foreach($levels as $level)
                                @if($level->grade_id == $level->id)
                                <option value="{{$level->id}}" selected> {{$level->label}}</option>
                                @else
                                <option value="{{$level->id}}"> {{$level->label}}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('grade_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('grade_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="program">Academic Group </label> <span id="live_loading"><i class="fa fa-spinner fa-spin"></i> Loading</span>
                        <select name="stream_id" class="custom-select d-block w-100 select2 {{ $errors->has('stream_id') ? ' is-invalid' : '' }}" id="stream" required>
                        </select>
                    </div>


                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Reactivate</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $('#level').on('change',function(){
      var level = $(this).val();
      if(level){
        $.ajax({
          type:"GET",
          url:"{{url('levels/get-streams')}}?level="+level,
          beforeSend: function()
          {
            $('#live_loading').css("visibility", "visible");
          },
          success:function(res){
            if(res){

              $("#stream").empty();
              $('#live_loading').css("visibility", "hidden");
              $.each(res,function(key,value)
              {
                $("#stream").append('<option value="'+key+'">'+value+'</option>'); });
              }else
              {
                $("#stream").empty();
              }
            } });
      }else{
        $("#stream").empty();
      }
    });

  </script>
@endpush
