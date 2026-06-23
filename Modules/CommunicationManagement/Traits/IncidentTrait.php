<?php

namespace Modules\CommunicationManagement\Traits;
use Modules\CalendarManagement\Entities\AcademicTerm;
use Modules\ClassroomManagement\Entities\Classroom;
use Modules\EnrolmentManagement\Entities\Enrolment;
use Illuminate\Http\Request;
use Modules\CommunicationManagement\Entities\Incident;
use Session;
use Auth;
use Carbon\Carbon;

trait IncidentTrait {


    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */

    public function saveIncident()
    {
        $this->incident = new Incident;
        $this->incident->label = $this->data['label'];
        $this->incident->incident_category_id = $this->data['incident_category_id'];
        $this->incident->academic_term_id = $this->data['academic_term_id'];
        $this->incident->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
        $this->incident->severity = !empty($this->data['severity']) ? $this->data['severity'] : 'Low';
        $this->incident->published = !empty($this->data['published']) ? $this->data['published'] : true;
        $this->incident->status = !empty($this->data['status']) ? $this->data['status'] : 'Scheduled';
        switch ($this->incident->incidentable_type){
            case "classroom":
                if(!isset($this->classroom))
                {
                    $this->classroom = Classroom::find(!empty($this->data['classroom_id']) ? $this->data['classroom_id'] : $this->incidentable_id);
                }
                $this->classroom->incidents()->save($this->incident);
            break;
            case "enrolment":
                if(!isset($this->enrolment))
                {
                    $this->enrolment = Enrolment::find(!empty($this->data['enrolment_id']) ? $this->data['enrolment_id'] : $this->incidentable_id);
                }
                $this->enrolment->incidents()->save($this->incident);            
            break;
            default:
            $this->incident->save();
        }       
        return $this->incident;
    }

    public function process(Request $request)
    {
        $this->validate($request, [
           'incident_id' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        $this->status = $request->status;
        $this->incident = Incident::findorFail($request->incident_id);

        switch ($this->status){
            case "Scheduled":

            // send notification to            
            break;
            case "Active":
                // send notification to 
                $this->incident->published = true;
                
            break;
            case "Closed":
            //send test notification to client
                $this->incident->published = false;
                $this->incident->closed_at = Carbon::now();
            break;
            case "Resolved":
                $this->incident->published = false;
                $this->incident->closed_at = Carbon::now();
            break;            
            default:
            return redirect()->back();
            //$this->incident->status = 'Scheduled';
            }
            $this->incident->status = $this->status;
            $this->msgtitle = 'success';
            $this->msgbody = $this->incident->status. ' Updated sucessfully';
            if($this->incident->save())
            {
                return redirect()->back()->with($this->msgtitle, $this->msgbody);
            }
    }

}
