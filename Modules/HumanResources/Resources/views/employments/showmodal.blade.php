<div class="modal fade" id="showemployment{{$employment->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Employment Details</h4>
            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>{{$employment->job_title}}</h6>    
                <p> <b> {{$employment->company}}; <small> {{$employment->location}} </small> </b> </p> 
                <p><b>Date: </b> {{$employment->period}}</p>
                 <p><b>Annual Salary:</b> {{$employment->annual_salary}}  </p>
                    <strong> <u> Accomplishments</u></strong> <br>
                        {!!$employment->achievements!!}
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit"> close </button>

            </div>
        </div>
    </div>
</div>