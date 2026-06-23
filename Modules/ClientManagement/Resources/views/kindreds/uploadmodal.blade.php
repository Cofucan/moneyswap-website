<a href="#upload" data-target="#upload" data-toggle="modal" class="btn btn-sm btn-primary px-3 mb-2">Upload Clients</a>
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Upload Clients </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
           
                <span><b>Follow the procedures to upload new clients </b></span>
                <ul>
                    <li> Download the bulk upload template file by clicking the 'Download Data Template' button. </li>
                    <li> Fill the  details on each row without modifying the column headers or file extension. </li>
                    <li> Browse to the location of the populated template file to attach it to the form </li>
                    <li> Click the 'Upload' button to complete the file upload</li>
                </ul>  
                <a href="{{ asset('files/clients.csv') }}" class="btn btn-primary btn-sm" download> <i class="fa fa-download"></i> Download Template</a>
                <hr>
                <form method="POST" action="{{ route('clients.import') }}" id="UploadStudent" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="academic_term_id" value="{{$cohort->academic_term_id}}">
                <input type="hidden" name="cohort_id" value="{{$cohort->id}}">
                <input type="hidden" name="batch_id" value="{{$cohort->batch_id}}">
                <input type="hidden" name="outlet_id" value="{{$cohort->outlet_id}}">
                <input type="hidden" name="enrolment_action" value="Re-enrolment">
                <p><b>Class:</b> {{$cohort->label}}</p>
                <p><b>Outlet:</b> {{$cohort->students_campus}}</p>
                <p><b>Term:</b> {{$cohort->school_term}}</p>

                    <div class="form-group">
                        <input type="file" name="file" class="form-control" required>
                    </div>                

                    <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Upload File</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>