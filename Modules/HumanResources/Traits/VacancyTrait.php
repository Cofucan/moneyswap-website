<?php

namespace Modules\HumanResources\Traits;

use Illuminate\Http\Request;
use Modules\HumanResources\Entities\Vacancy;
use Modules\HumanResources\Entities\Designation;
use Modules\CalendarManagement\Entities\AcademicTerm;
use App\Notifications\VacancyApproved;
use Modules\ProfileManagement\Traits\ProfileTrait;
use Modules\CommunicationManagement\Traits\ObjectionTrait;
use Auth;
use Carbon\Carbon;
use Session;
use File;

trait VacancyTrait {
    use ProfileTrait;
    use ObjectionTrait;


    public function saveVacancy()
    {
        if(isset($this->data['vacancy_id']) || isset($this->vacancy_id)){
            $this->vacancy = Vacancy::findorFail(!empty($this->data['vacancy_id']) ? $this->data['vacancy_id'] : $this->vacancy_id);
        }else{
            $this->vacancy = new Vacancy;
            $this->vacancy->employment_type_id = $this->data['employment_type_id'];
            $this->vacancy->academic_term_id = !empty($this->data['academic_term_id']) ? $this->data['academic_term_id'] : $this->academic_term_id;
            // $this->vacancy->organization_id = $this->data['organization_id'];
            $this->vacancy->employment_type_id = $this->data['employment_type_id'];
            $this->vacancy->designation_id = $this->data['designation_id'];
            // $this->vacancy->department_id = $this->data['department_id'];
            $this->vacancy->vacancy_ref = !empty($this->data['vacancy_ref']) ? $this->data['vacancy_ref'] : $this->generateVacancyRef();
            $this->vacancy->campus_id = !empty($this->data['campus_id']) ? $this->data['campus_id'] : $this->campus_id;
        }
        //
        $this->vacancy->vacancy_title = !empty($this->data['vacancy_title']) ? $this->data['vacancy_title'] : $this->generateJobTitle();
        $this->vacancy->employees_needed = !empty($this->data['employees_needed']) ? $this->data['employees_needed'] : '1';
        $this->vacancy->years_of_experience = !empty($this->data['years_of_experience']) ? $this->data['years_of_experience'] : $this->years_of_experience;
        $this->vacancy->salary_from = (float) str_replace(',', '', !empty($this->data['salary_from']) ? $this->data['salary_from'] : $this->salary_from);
        $this->vacancy->salary_to = (float) str_replace(',', '', !empty($this->data['salary_to']) ? $this->data['salary_to'] : $this->salary_to);
        $this->vacancy->currency = !empty($this->data['currency']) ? $this->data['currency'] : 'NGN';
        $this->vacancy->payment_cycle = !empty($this->data['payment_cycle']) ? $this->data['payment_cycle'] : 'Monthly';
        $this->vacancy->display_salary = !empty($this->data['display_salary']) ? $this->data['display_salary'] : true;
        $this->vacancy->expected_start_date = !empty($this->data['expected_start_date']) ? $this->data['expected_start_date'] : Carbon::now()->addDay(7);
        $this->vacancy->email = !empty($this->data['email']) ? $this->data['email'] : '';
        $this->vacancy->qualification_id = !empty($this->data['qualification_id']) ? $this->data['qualification_id'] : '';
        $this->vacancy->close_at = !empty($this->data['close_at']) ? $this->data['close_at'] : Carbon::now()->addMonth();
        $this->vacancy->application_method = !empty($this->data['application_method']) ? $this->data['application_method'] : 'Online';
        $this->vacancy->application_threshold = !empty($this->data['application_threshold']) ? $this->data['application_threshold'] : '0'; // 0 - unlimited
        $this->vacancy->overview = !empty($this->data['overview']) ? $this->data['overview'] : '';
        $this->vacancy->responsibilities = !empty($this->data['responsibilities']) ? $this->data['responsibilities'] : '';
        $this->vacancy->other_requirements = !empty($this->data['other_requirements']) ? $this->data['other_requirements'] : '';
        $this->vacancy->description = !empty($this->data['description']) ? $this->data['description'] : '';
        $this->vacancy->status = !empty($this->data['status']) ? $this->data['status'] : 'Scheduled';
        $this->vacancy->published = !empty($this->data['publishe']) ? $this->data['publishe'] : '0';
        if(!$this->vacancy->save())
        {
            return redirect()->back()->withInput()->withErrors('Error creating vacancy');
        }
        return $this->vacancy;
    }

    public function generateJobTitle()
    {
        $designation = Designation::findOrFail($this->data['designation_id']);
        return $designation->job_role."-". $this->vacancy->vacancy_ref;
    }

    public function PaymentCycles()
    {
        return [
            'Monthly' => 'Monthly',
            'Weekly' => 'Weekly',
            'Annually' => 'Annually',
        ];
    }

    public function generateVacancyRef()
    {
        $ref = Designation::max('id')+1;
        return date('Y'). $ref;
    }
    public function SchoolVacancies()
    {
         $vacancy = vacancy::userinvoices()->paginate(5);
         //$vacancy = vacancy::paginate(5);
         return view('vacancy.userinvoices', compact('vacancy'));
    }

    public function vacancy($slug)
    {
        $vacancy = Vacancy::where('slug', $slug)->first();
        return view('vacancies.vacancy', compact('vacancy'));
    }

    public function VacancyProcessor()
    {
        if(!isset($this->vacancy)){
            $vacancy_id = !empty($this->data['vacancy_id']) ? $this->data['vacancy_id'] : $this->vacancy_id;
            $this->vacancy = Vacancy::findorFail($vacancy_id);
        }
        $status = !empty($this->data['status']) ? $this->data['status'] : $this->status;

        switch ($status){
            case "Scheduled":
               $this->vacancy->user_id == Auth::id();
               if(is_null($this->vacancy->vacancy_ref))
               {
                   $this->vacancy->vacancy_ref = $this->vacancy->campus_id.time();
               }
            break;
            case "Approved":
                $this->vacancy->date_approved = Carbon::today();
                $this->vacancy->approved_by = Auth::id();
                $this->vacancy->published = true;
                $this->vacancy->close_at =  Carbon::today()->addMonth() ;
                if(is_null($this->vacancy->vacancy_ref))
                {
                    $this->vacancy->vacancy_ref = $this->vacancy->campus_id.time();
                }
            //notify the employer
            // $this->vacancy->notify(new VacancyApproved($this->vacancy));
            break;

            case "Accepted":
                $this->makeBid();
                //notify the buyer
            break;
            case "Reported":
                $this->DeclineOffer();
                //notify the buyer
            break;
            case "Rejected":
                $this->vacancy->Objections()->save($this->makeObjection());
                //notify the buyer
            break;
            }
            $this->vacancy->status = $status;
            if($this->vacancy->save()){
                return $this->vacancy;
            }
    }


    /* $clients = Client::with('latestBill')->get();
    foreach ($authors as $author) {
        echo $author->name . ': ' . $author->latestBook->title;
    } */
}
