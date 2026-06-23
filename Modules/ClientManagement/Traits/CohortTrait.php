<?php
namespace Modules\ClientManagement\Traits;
use Modules\ClientManagement\Entities\Cohort;
use Modules\CalendarManagement\Entities\AcademicTerm;
use Modules\ClientManagement\Traits\ClientTrait;
use Carbon\carbon;
use DB;
use Auth;

trait CohortTrait {
    use ClientTrait;

    public function cohortstats()
    {
    return DB::table('cohorts')
    ->selectRaw('count(*) as total')
    ->selectRaw("count(case when status = 'Active' then 1 end) as Active")
    ->selectRaw("count(case when status = 'Discontinued' then 1 end) as Discontinued")
    ->selectRaw("count(case when status = 'Draft' then 1 end) as Draft")
    ->selectRaw("count(case when status = 'Graduated' then 1 end) as Graduated")
    ->first();
    }

public function saveCohort()
{
    $cohort = new Cohort;
    $cohort->outlet_id = !empty($this->data['outlet_id']) ? $this->data['outlet_id'] : NULL;
    $cohort->academic_term_id = !empty($this->data['academic_term_id']) ? $this->data['academic_term_id'] : AcademicTerm::current()->id;
    $cohort->batch_id = $this->data['batch_id'];
    $cohort->enrolment_type = !empty($this->data['enrolment_type']) ? $this->data['enrolment_type'] : 'Returning';;
    $cohort->overview = !empty($this->data['overview']) ? $this->data['overview'] : NULL;
    if ( !$cohort->save()) {
        return redirect()->back()->withInput()->withErrors('Data entry error');
    }
    return $cohort;
}

public function processCohort($cohort = null)
{
    if(!isset($cohort)){
        $cohort = Cohort::findorFail(!empty($this->data['cohort_id']) ? $this->data['cohort_id'] : $this->cohort_id);
    }
    $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;

    switch ($status){
        case "Scheduled":
            $cohort->enabled = true;
            $cohort->scheduled_at = Carbon::now();
        break;
        case "Approved":
        $cohort->approver_user_id = Auth::id();
        if(is_null($cohort->scheduled_at))
        {
            $cohort->scheduled_at = Carbon::now();
        }
        $cohort->enabled = false;
        break;
        case "Rejected":
            $cohort->Objections()->save($this->makeObjection());
            $cohort->enabled = false;
        break;
        }
        $cohort->status = $status;
        $this->destination = 'cohorts.show';
        if($cohort->save()){
            foreach($cohort->clients as $client)
            {
                $this->processStudent($client);
            }
            return $this->destination;
        }
}


}
